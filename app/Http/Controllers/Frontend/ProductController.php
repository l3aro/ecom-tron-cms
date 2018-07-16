<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function show(Request $request, $item) {
        $dataView = [];
        
        $product = Product::where('slug',$item)->first();
        $title = $product->name;
        $banner = $product->image;
        $product_image = ProductImage::where('product_id', $product->id)->get();
        $related_product = Product::where('id','<>',$product->id)->where('cat', $product->product_cat()->first()->id)->limit(4)->get();

        $dataView['product'] = $product;
        $dataView['banner'] = $banner;
        $dataView['title'] = $title;
        $dataView['product_image'] = $product_image;        
        $dataView['related_product'] = $related_product;
        return Theme::uses()->scope('product-details', $dataView)->setTitle($title)->render();
    }
}
