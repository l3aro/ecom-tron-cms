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
        $title = 'Product Categories';
        $theme = Theme::uses();
        
        if ($category == 'new-in') {
            $title = 'New Products';
            $products = Product::where('new',1)->latest()->paginate(9);
        }
        else if ($category == 'promo') {
            $title = 'Promotion Products';
            $products = Product::where('discount','>',0)->latest()->paginate(9);
        }
        else if ($category == 'products') {
            $title = "Products";
            $products = Product::latest()->paginate(9);
        }
        else {
            $cat = Category::where('slug', $category)->first();
            $dataView['banner'] = $cat->image;
            $title = $cat->name;
            $products = Product::where('cat',$cat->id)->latest()->paginate(9);
        }

        $left_menu_id = MenuCat::where('name', 'left-menu')->first();
        if ($left_menu_id) {
            $left_menu = Menu::where([['cat', $left_menu_id->id],['parent', 0]])->orderBy('order', 'asc')->get();
        }

        $featured_product = Product::where('highlight',1)->inRandomOrder()->limit(2)->get();

        $dataView['products'] = $products;
        $dataView['title'] = $title;
        $dataView['left_menu'] = $left_menu;
        $dataView['featured_product'] = $featured_product;

        return $theme->scope('categories-left-sidebar', $dataView)->setTitle($title)->render();
    }
}
