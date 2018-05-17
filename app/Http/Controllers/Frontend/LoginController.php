<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class LoginController extends Controller
{
    public function show() {
        return Theme::uses()->scope('login')->setTitle('Login')->render();
    }
}
