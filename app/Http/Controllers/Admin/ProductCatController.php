<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
use Auth;
use App\Libraries\UploadFile;
use App\Models\Category;
use Illuminate\Support\Collection;

class ProductCatController extends Controller
{
    /**
     * Show list of product categories
     * 
     * @param Request  $request
     * @return Response
     */
    public function index() {
        $categories = Category::where('parent', '0')->where('type',1)->latest()->get()
        ->map(function($q) {
            $sub = $this->getSubCategories($q->id);
            $q->sub = $sub;
            return $q;
        });
        $dataView['categories'] = $categories;  
        return Theme::uses('visitors')->scope('product-cat.index',$dataView)->setTitle('Product Category')->render();
    }

    private function getSubCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        $condition[] = ['type', 1];
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
     * Add new or edit an exist product category
     * 
     * @param Request $request
     * @param product_cat_id $id
     * @return mixed
     */
    public function detail(Request $request) {
        $saved = 0;
        $slug_exists = 0;
        $dataView = [];
        $category = null;

        if ($request->id !== null) {
            $category = Category::where('id', $request->id)->first();
        }
        else if ($request->parent != null) {
            $category = new Category();
            $category->parent = $request->parent;
        }
        else {
            $category = new Category();
        }
        $category->type = 1;
        $process_id = $request->id;
        $list_cat = Category::where('parent', '0')->where('id','<>',$process_id)->where('type',1)->latest()->get()
        ->map(function($q) use($process_id) {
            $sub = $this->getSubCategories($q->id, $process_id);
            $q->sub = $sub;
            return $q;
        });    
        
        if ($request->isMethod('post')) {
            if($request->file('image') && $request->file('image')->isValid()){
                $folder = public_path('media/product-cat/');
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
                    return Theme::uses('visitors')->scope('product-cat.detail',$dataView)->setTitle('Product Category')->render();
                }
            }
            else {
                $category->save();
                $slug = str_slug($request->name, '-');
                if (Category::where([['slug',$slug],['id','<>',$category->id]])->first()) {
                    $category->slug = $slug;
                    $slug_exists = 2;
                    $dataView['saved'] = $saved;
                    $dataView['category'] = $category;
                    $dataView['list_cat'] = $list_cat;
                    $dataView['slug_exists'] = $slug_exists;
                    return Theme::uses('visitors')->scope('product-cat.detail',$dataView)->setTitle('Product Category')->render();
                }
            }
            $category->slug = $slug;
            $category->save();
            $process_id = $category->id;
            $list_cat = Category::where('parent', '0')->where('type',1)->latest()->get()
            ->map(function($q) use($process_id) {
                $sub = $this->getSubCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });    
            $saved = 1;
        }

        $dataView['saved'] = $saved;
        $dataView['slug_exists'] = $slug_exists;
        $dataView['category'] = $category;
        $dataView['list_cat'] = $list_cat;
        return Theme::uses('visitors')->scope('product-cat.detail',$dataView)->setTitle('Product Category')->render();
    }

    /**
     * Determine input category have product in it/its children or not
     * 
     * @param $id productcat_id
     * @return bool
     */
    private function validate_delete_child_cat($id) {
        if (Category::find($id) == null)
            return 1;
        $cat = Category::where('id', $id)->first();
        if ($cat->product()->count() > 0) {
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
     * Delete an product category and its children
     * 
     * @param $id product_id
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
            die('done');
        else
            die($not_delete);
    }

    /**
     * Delete product category's image
     * 
     * @param $id productcat-id
     * @return mixed
     */
    public function delete_image($id){
        $product_cat = Category::find($id);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/media/product-cat/';
        if ($product_cat->image) {
            if (file_exists($folder . $product_cat->image))	unlink($folder . $product_cat->image);
            if (file_exists($folder . 'tb/' . $product_cat->image))	unlink($folder . 'tb/' . $product_cat->image);
            $product_cat->image = '';
            $product_cat->save();
        }
    }
}
