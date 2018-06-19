<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Product;
use App\Models\MenuCat;
use App\Models\Menu;

class SearchController extends Controller
{
    /**
     * Show search page
     */
    public function show(Request $request, $keyword = null) {
        $dataView = [];

        if ($keyword!==null) {
            $products = Product::where('name', 'like', '%'.$keyword.'%')->paginate(9);
            $dataView['products'] = $products;
        }
        
        $left_menu_id = MenuCat::where('name', 'left-menu')->first();
        if ($left_menu_id) {
            $left_menu = Menu::where([['cat', $left_menu_id->id],['parent', 0]])->orderBy('order', 'asc')->get();
        }

        $title = 'Search';
        $featured_product = Product::where('highlight',1)->inRandomOrder()->limit(2)->get();

        $dataView['title'] = $title;
        $dataView['left_menu'] = $left_menu;
        $dataView['featured_product'] = $featured_product;
        return Theme::uses()->scope('search', $dataView)->setTitle($title)->render();
    }
}
