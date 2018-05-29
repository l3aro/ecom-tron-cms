<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use Auth;
use App\Models\Article;
use App\Models\ArticleCat;
use App\Libraries\UploadFile;

class ArticleController extends Controller
{
    public function index(Request $request) {
        return Theme::uses('visitors')->scope('article.index')->render();
    }

    /**
     * Add new or edit an exist article
     * 
     * @param Request $request
     * @return Response
     */
    public function detail(Request $request) {
        $saved = 0;
        $slug_exists = 0;
        $dataView = [];
        $article = null;
        $list_cat = null;

        if ($request->id !== null) {
            $article = Article::where('id', $request->id)->first();
        }
        else if ($request->act == 'copy') {
            $article = Article::where('id', $request->id)->first();
            $article->id = null;
            $article->public = 0;
            $article->highlight = 0;
            $article->new = 0;
        }
        else {
            $article = new Article();
        }

        // $list_cat = new ArticleCat();
        // $list_cat = $list_cat->GetOptions($article->cat);

        if ($request->isMethod('post')) {
            if($request->file('image') && $request->file('image')->isValid()){
                $folder = public_path('media/article/');
                $image = UploadFile::uploadImage($_FILES['image'], $folder, $article->image);
            } 
            else if ($article->id==null && $request->current_image!=null) {
                $folder = public_path('media/article/');
                $img_name = $request->current_image;
                $path_parts = pathinfo($folder.$img_name);
                $ext = $path_parts['extension'];
                list($usec, $sec) = explode(".", microtime(true));
                $new_img_name = $usec.$sec.".".$ext;
                
                if (file_exists($folder.$img_name)) copy ($folder.$img_name, $folder.$new_img_name);
                if (file_exists($folder.'tb/'.$img_name)) copy ($folder.'tb/'.$img_name, $folder.'tb/'.$new_img_name);
                $image = $new_img_name;
            }
            else {
                $image = $article->image;
            }
            $article->name = $request->name;
            $article->cat = $request->cat?$request->cat:'0';
            $article->image = $image?$image:'';
            $article->des = $request->des?$request->des:'';
            $article->detail = $request->detail?$request->detail:'';
            $article->page_title = $request->page_title?$request->page_title:'';
            $article->public = isset($request->public)?1:0;
            $article->new = isset($request->new)?1:0;
            $article->highlight = isset($request->highlight)?1:0;
            $article->updated_by = Auth::id();
            
            if ($request->slug) {
                $slug = $request->slug;
                if (Article::where([['slug',$slug],['id','<>',$article->id]])->first()) {
                    $article->slug = $slug;
                    $slug_exists = 1;
                    $dataView['slug_exists'] = $slug_exists;
                    $dataView['saved'] = $saved;
                    $dataView['article'] = $article;
                    $dataView['list_cat'] = $list_cat;
                    return Theme::uses('visitors')->scope('article.detail', $dataView)->render();
                }
            }
            else {
                $article->save();
                $slug = str_slug($request->name."-".$article->id, '-');
            }
            $article->slug = $slug;
            $article->save();

            // $list_cat = new ArticleCat();
            // $list_cat = $list_cat->GetOptions($article->cat);
            
            $saved = 1;
        }

        $dataView['slug_exists'] = $slug_exists;
        $dataView['saved'] = $saved;
        $dataView['article'] = $article;
        $dataView['list_cat'] = $list_cat;
        return Theme::uses('visitors')->scope('article.detail', $dataView)->render();
    }
}
