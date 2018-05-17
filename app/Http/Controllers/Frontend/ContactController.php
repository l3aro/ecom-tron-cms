<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class ContactController extends Controller
{
    public function show() {
        return Theme::uses()->scope('contact')->setTitle('Contact')->render();
    }
}
