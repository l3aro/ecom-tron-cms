<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class HomeController extends Controller
{
    public function dashboard(Request $request) {
        return Theme::uses('visitors')->scope('index')->setTitle('Dashboard')->render();
    }
}
