<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class OrderController extends Controller
{
    public function show() {
        return Theme::uses()->scope('shopping-cart')->setTitle('Cart')->render();
    }
}
