<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use App\Models\Article;
use App\Models\Category;

class ArticleCatController extends Controller
{
    public function show(Request $request, $category) {
        $dataView = [];
        $title = 'Danh mục bài viết';
        $theme = Theme::uses();

        $cat = Category::where('slug', $category)->first();
        $dataView['banner'] = $cat->image;
        $title = $cat->name;
        $articles = Article::where('cat',$cat->id);

        if ($request->filter == 'name') {
            $articles = $articles->orderBy('name','asc');
        }
        else if ($request->filter == 'oldest') {
            $articles = $articles->oldest();
        }
        else {
            $articles = $articles->latest();
        }

        $articles = $articles->paginate(9);

        $dataView['articles'] = $articles;
        $dataView['title'] = $title;

        if ($request->ajax()) {
            return $theme->scope('list-article',$dataView)->content();
        }

        return $theme->scope('categories-no-sidebar', $dataView)->setTitle($title)->render();
    }

}
