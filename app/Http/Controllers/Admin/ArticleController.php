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
    /**
     * Show list of articles
     * 
     * @param \Request  $request
     * @return \Response
     */
    public function index(Request $request) {
        $dataView = [];
        $articles = null;
        $condition = [];

        $condition[] = ['name', 'like', '%'.$request->f_name.'%'];

        $articles = Article::where($condition)->orderBy('created_at','desc')->paginate(8);
        $dataView['articles'] = $articles;

        if ($request->ajax()) {
            return Theme::uses('visitors')->scope('article.list',$dataView)->content();
        }
        return Theme::uses('visitors')->scope('article.index',$dataView)->render();
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

        if ($request->act == 'copy') {
            $article = Article::where('id', $request->id)->first();
            $article->id = null;
            $article->public = 0;
            $article->highlight = 0;
            $article->new = 0;
        }
        else if ($request->id !== null) {
            $article = Article::where('id', $request->id)->first();
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

    /**
     * Change an attribute of [public, highlight, new] to true or false
     * 
     * @param \Request
     */
    public function changefield(Request $request) {
        $field = $request->field;
        $article = Article::find($request->id);
        $article->$field = $request->p?'0':'1';
        $article->save();
        die($request->p);
    }

    /**
     * Delete an article or multi articles
     * 
     * @param $id the id number of article(s)
     */
    public function delete(Request $request) {
        $article = Article::find(explode(',', $request->id));
        foreach($article as $key=>$value) {
            if ($value->image)
                $this->delete_image($value->id);
            $value->delete();
        }
    }

    /**
     * Delete article's image
     * 
     * @param $id article-id
     * @return mixed
     */
    public function delete_image($id){
        $article = Article::find($id);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/media/article/';
        if (file_exists($folder . $article->image))	unlink($folder . $article->image);
        if (file_exists($folder . 'tb/' . $article->image))	unlink($folder . 'tb/' . $article->image);
        $article->image = '';
        $article->save();
    }
}
