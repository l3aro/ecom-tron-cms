<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class ProductController extends Controller
{
    public function show() {
        return Theme::uses()->scope('product-details')->setTitle('Product Detail')->render();
    }
}
