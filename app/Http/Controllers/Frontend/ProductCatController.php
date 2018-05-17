<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class ProductCatController extends Controller
{
    public function show() {
        return Theme::uses()->scope('categories-left-sidebar')->setTitle('Product Categories')->render();
    }
}
