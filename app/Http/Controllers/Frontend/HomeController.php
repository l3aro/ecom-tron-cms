<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class HomeController extends Controller
{
    public function show() {
        return Theme::uses()->scope('index')->setTitle('Home')->render();
    }
}
