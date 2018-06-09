<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Category;
use App\Models\Product;

class ProductCatController extends Controller
{
    public function show(Request $request, $category) {
        $dataView = [];
        $title = 'Product Categories';
        
        if ($category == 'new-in') {
            $title = 'New Products';
            $products = Product::where('new',1)->latest()->paginate(9);
        }
        else if ($category == 'promo') {
            $title = 'Promotion Products';
            $products = Product::where('discount','>',0)->latest()->paginate(9);
        }
        else {
            $cat = Category::where('slug', $category)->first();
            $dataView['banner'] = $cat->image;
            $title = $cat->name;
            $products = Product::where('cat',$cat->id)->latest()->paginate(9);
        }

        $dataView['products'] = $products;
        return Theme::uses()->scope('categories-left-sidebar', $dataView)->setTitle($title)->render();
    }
}
