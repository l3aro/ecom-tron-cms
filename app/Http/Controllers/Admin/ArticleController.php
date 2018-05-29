<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;

class ArticleController extends Controller
{
    public function index(Request $request) {
        return Theme::uses('visitors')->scope('article.index')->render();
    }

    public function detail(Request $request) {
        return Theme::uses('visitors')->scope('article.detail')->render();
    }
}
