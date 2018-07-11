<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Product;

class HomeController extends Controller
{
    public function show() {
        $dataView = [];
        $products = Product::latest()->limit(12)->get();

        $dataView['products'] = $products;
        return Theme::uses()->scope('index', $dataView)->setTitle('Trang chủ')->render();
    }
}
