<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show(Request $request, $item) {
        $dataView = [];
        
        $article = Article::where('slug',$item)->first();
        $title = $article->name;
        $banner = $article->article_cat()->first()->image ?? '';
        // $related_article = Product::where('id','<>',$article->id)->where('cat', $article->article_cat()->first()->id)->limit(4)->get();

        $dataView['article'] = $article;
        $dataView['banner'] = $banner;
        $dataView['title'] = $title;   
        // $dataView['related_article'] = $related_article;
        return Theme::uses()->scope('blog', $dataView)->setTitle($title)->render();
    }
}
