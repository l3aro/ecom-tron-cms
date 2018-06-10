<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use Auth;
use App\Libraries\UploadFile;
use App\Models\Category;
use Illuminate\Support\Collection;

class ArticleCatController extends Controller
{
    /**
     * Show list of article categories
     * 
     * @param Request  $request
     * @return Response
     */
    public function index() {
        $categories = Category::where('parent', 0)->where('type',0)->latest()->get()
        ->map(function($q) {
            $sub = $this->getSubCategories($q->id);
            $q->sub = $sub;
            return $q;
        });
        $dataView['categories'] = $categories;  
        return Theme::uses('visitors')->scope('article-cat.index',$dataView)->setTitle('Article Category')->render();
    }

    private function getSubCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        $condition[] = ['type', 0];
        if ($process_id !== null) {
            $condition[] = ['id', '<>', $process_id];
        }
        $cat = Category::where($condition)->get();
        if ($cat->count() > 0) {
            $cat->map(function($q) use($process_id) {
                $sub = $this->getSubCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });
            return $cat;
        }
        return null;
    }

    /**
     * Add new or edit an exist article category
     * 
     * @param Request $request
     * @param article_cat_id $id
     * @return mixed
     */
    public function detail(Request $request) {
        $saved = 0;
        $slug_exists = 0;
        $dataView = [];
        $category = null;

        if ($request->id !== null) {
            $category = Category::where('id', $request->id)->where('type', 0)->first();
        }
        else if ($request->parent != null) {
            $category = new Category();
            $category->parent = $request->parent;
        }
        else {
            $category = new Category();
        }
        $category->type = 0;
        $process_id = $request->id;
        $list_cat = Category::where('parent', 0)->where('type', 0)->latest()->get()
        ->map(function($q) use($process_id) {
            $sub = $this->getSubCategories($q->id, $process_id);
            $q->sub = $sub;
            return $q;
        });    
        
        if ($request->isMethod('post')) {
            if($request->file('image') && $request->file('image')->isValid()){
                $folder = public_path('media/article-cat/');
                $image = UploadFile::uploadImage($_FILES['image'], $folder, $category->image);
            } else {
                $image = $category->image;
            }
            $category->name = $request->name;
            $category->parent = $request->parent?$request->parent:0;
            $category->image = $image?$image:'';
            $category->des = $request->des?$request->des:'';
            $category->page_title = $request->page_title?$request->page_title:'';
            $category->highlight = isset($request->highlight)?1:0;
            $category->updated_by = Auth::id();

            if ($request->slug) {
                $slug = $request->slug;
                if (Category::where([['slug',$slug],['id','<>',$category->id]])->first()) {
                    $category->slug = $slug;
                    $slug_exists = 1;
                    $dataView['saved'] = $saved;
                    $dataView['category'] = $category;
                    $dataView['list_cat'] = $list_cat;
                    $dataView['slug_exists'] = $slug_exists;
                    return Theme::uses('visitors')->scope('article-cat.detail',$dataView)->setTitle('Article Category')->render();
                }
            }
            else {
                $slug = str_slug($request->name, '-');
                if (Category::where([['slug',$slug],['id','<>',$category->id]])->first()) {
                    $category->slug = $slug;
                    $slug_exists = 2;
                    $dataView['saved'] = $saved;
                    $dataView['category'] = $category;
                    $dataView['list_cat'] = $list_cat;
                    $dataView['slug_exists'] = $slug_exists;
                    return Theme::uses('visitors')->scope('article-cat.detail',$dataView)->setTitle('Article Category')->render();
                }
            }
            $category->slug = $slug;
            $category->save();
            $process_id = $category->id;  
            $saved = 1;
        }

        $dataView['saved'] = $saved;
        $dataView['slug_exists'] = $slug_exists;
        $dataView['category'] = $category;
        $dataView['list_cat'] = $list_cat;
        return Theme::uses('visitors')->scope('article-cat.detail',$dataView)->setTitle('Article Category')->render();
    }

    /**
     * Determine input category have article in it/its children or not
     * 
     * @param $id articlecat_id
     * @return bool
     */
    private function validate_delete_child_cat($id) {
        if (Category::find($id) == null)
            return 1;
        $cat = Category::find($id);
        if ($cat->article()->count() > 0) {
            return 0;
        }
        if (Category::where('parent', $cat->id)->count() > 0) {
            foreach (Category::where('parent', $cat->id)->get() as $key=>$value) {
                if ($this->validate_delete_child_cat($value->id) == 0) {
                    return 0;
                }
            }
        }
        return 1;
    }

    /**
     * Delete an article category and its children
     * 
     * @param $id article_id
     */
    private function delete_child_cat($id) {
        if (Category::find($id) == null)
            return;
        if (Category::where('parent', $id)->count() > 0) {
            foreach (Category::where('parent', $id)->get() as $key=>$value) {
                $this->delete_child_cat($value->id);
            }
        }
        $this->delete_image($id);
        Category::find($id)->delete();
    }

    /**
     * Delete multi categories
     * 
     * @param Request
     */
    public function delete(Request $request) {
        $not_delete = '';
        foreach (explode(',', $request->id) as $key=>$value) {
            if ($this->validate_delete_child_cat($value) != 0) {
                $this->delete_child_cat($value);
            }
            else {
                $not_delete .= $value.',';
            }    
        }
        if ($not_delete == '')
            die('1');
        else
            die($not_delete);
    }

    /**
     * Delete article category's image
     * 
     * @param $id articlecat-id
     * @return mixed
     */
    public function delete_image($id){
        $article_cat = Category::find($id);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/media/article-cat/';
        if ($article_cat->image) {
            if (file_exists($folder . $article_cat->image))	unlink($folder . $article_cat->image);
            if (file_exists($folder . 'tb/' . $article_cat->image))	unlink($folder . 'tb/' . $article_cat->image);
            $article_cat->image = '';
            $article_cat->save();
        }
    }
}
