<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Category;
use App\Models\Product;
use App\Models\Menu;
use App\Models\MenuCat;

class ProductCatController extends Controller
{
    public function show(Request $request, $category) {
        $dataView = [];
        $title = 'Danh mục sản phẩm';
        $theme = Theme::uses();
        $minPrice = 1000;
        $maxPrice = 10000000;
        if ($request->min && $request->max) {
            $minPrice = $request->min;
            $maxPrice = $request->max;
        }
        if ($category == 'hang-moi-ve') {
            $title = 'Sản phẩm mới';
            $products = Product::whereBetween('price', [$minPrice, $maxPrice])->where('new',1);
        }
        else if ($category == 'khuyen-mai') {
            $title = 'Sản phẩm khuyến mãi';
            $products = Product::whereBetween('price', [$minPrice, $maxPrice])->where('discount','>',0);
        }
        else if ($category == 'danh-muc-san-pham') {
            $title = "Danh mục sản phẩm";
            $products = Product::whereBetween('price', [$minPrice, $maxPrice]);
        }
        else {
            $cat = Category::where('slug', $category)->first();
            $dataView['banner'] = $cat->image;
            $title = $cat->name;
            $products = Product::whereBetween('price', [$minPrice, $maxPrice])->where('cat',$cat->id);
        }

        if ($request->filter == 'latest') {
            $products = $products->latest();
        }
        else if ($request->filter == 'oldest') {
            $products = $products->oldest();
        }
        else if ($request->filter == 'highest') {
            $products = $products->orderBy('price', 'desc');
        }
        else if ($request->filter == 'lowest') {
            $products = $products->orderBy('price','asc');
        }
        else {
            $products = $products->orderBy('name','asc');
        }

        $products = $products->paginate(9);

        $left_menu_id = MenuCat::where('name', 'left-menu')->first();
        if ($left_menu_id) {
            $left_menu = Menu::where([['cat', $left_menu_id->id],['parent', 0]])->orderBy('order', 'asc')->get()
            ->map(function($q) {
                $sub = $this->getSubMenuCategories($q->id);
                $q->sub = $sub;
                return $q;
            });
        }

        $featured_product = Product::where('highlight',1)->inRandomOrder()->limit(2)->get();

        $dataView['products'] = $products;
        $dataView['title'] = $title;
        $dataView['left_menu'] = $left_menu;
        $dataView['featured_product'] = $featured_product;

        if ($request->ajax()) {
            return $theme->scope('list-product',$dataView)->content();
        }

        return $theme->scope('categories-left-sidebar', $dataView)->setTitle($title)->render();
    }

    
    /**
     * Get list sub category of certain menu
     * 
     * @param int id of category where we search its sub
     * @param int id of current menu should be ignored
     * @return Collection the list sub
     * @return null
     */
    private function getSubMenuCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        if ($process_id !== null) {
            $condition[] = ['id', '<>', $process_id];
        }
        $cat = Menu::where($condition)->orderBy('order','asc')->get();
        if ($cat->count() > 0) {
            $cat->map(function($q) use($process_id) {
                $sub = $this->getSubMenuCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });
            return $cat;
        }
        return null;
    }
}
