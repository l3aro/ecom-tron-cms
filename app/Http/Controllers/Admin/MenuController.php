<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Product;
use App\Models\MenuCat;
use App\Models\Category;
use Auth;
use Theme;
use Response;

class MenuController extends Controller
{
    /**
     * List option URL
     * 
     * @param Request
     * @return Response
     */
    public function index(Request $request){
        $dataView = [];
        $conditions = [];
        $conditions[] = ['cat', $request->cat];
        $conditions[] = ['parent', 0];
        $categories = Menu::where($conditions)->orderBy('order', 'asc')->get()
        ->map(function($q) {
            $sub = $this->getSubMenuCategories($q->id);
            $q->sub = $sub;
            return $q;
        });
        $dataView['categories'] = $categories;
        $dataView['cat'] = $request->cat;
        return Theme::uses('visitors')->scope('menu.index', $dataView)->setTitle('List URLs')->render();
    }

    /**
     * Add or edit option menu
     * 
     * @param Request
     * @return Response
     */
    public function detail(Request $request){
        $menu = Menu::find($request->id);
        if(!$menu){
            $menu = new Menu;
        }
        $menucat = MenuCat::orderBy('id','desc')->get();
        $dataView = [];
        $dataView['saved'] = 0;
        $parent = $request->parent;
        if ($parent) {
            $menu->parent = $parent;
        }
        $cat = $request->cat;
        if (!$cat) {
            $cat = $menu->cat;
        }
        if ($request->isMethod('post')) {
            
            $menu->name = $request->name;
            $menu->cat = $request->cat;
            $menu->type = $request->type;
            $menu->parent = (int)$request->parent;
            $menu->article_id = (int)$request->article_id;
            $menu->article_cat = (int)$request->article_cat;
            $menu->product_id = (int)$request->product_id;
            $menu->product_cat = (int)$request->product_cat;
            $menu->link = $this->generateLink($request);
            $menu->des = $request->des?$request->des:'';
            $menu->order = $menu->order?$menu->order:(Menu::max('order') ? (Menu::max('order') + 1) : 1);
            $menu->updated_by = Auth::id();
            $menu->save();
            $dataView['saved'] = 1;
        }
        $dataView['menu'] = $menu;
        $dataView['cat'] = $cat;
        $dataView['menu_options'] = $this->getSubMenuCategories(0);
        $dataView['article_cat_options'] = $this->getSubArticleCategories(0);
        $dataView['product_cat_options'] = $this->getSubProductCategories(0);
    	return Theme::uses('visitors')->scope('menu.detail', $dataView)->setTitle('Option Detail')->render();
    }

    /**
     * Generate menu link
     * 
     * @param Request
     * @return string
     */
    private function generateLink(Request $request) {
        switch ($request->type) {
            case '1':
                $id = (int)$request->article_cat;
                $slug = Category::find($id)->slug;
                return '/'.$slug;
            case '2':
                return '/articles';
            case '3':
                $id = (int)$request->article_id;
                $slug = Article::find($id)->slug;
                return '/article//'.$slug;
            case '4':
                $id = (int)$request->product_cat;
                $slug = Category::find($id)->slug;
                return '/'.$slug;
            case '5':
                return '/products';
            case '6':
                $id = (int)$request->product_id;
                $slug = Article::find($id)->slug;
                return '/product//'.$slug;
            case '7':
                return '/new-in';
            case '8':
                return '/promo';      
            default:
                return $request->link;  
        }
    }

    /**
     * Get list sub category of certain menu
     * 
     * @param int id of category where we search its sub
     * @param int id of current menu should be ignored
     * @return Collection the list sub
     * @return null
     */
    private function getSubMenuCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        if ($process_id !== null) {
            $condition[] = ['id', '<>', $process_id];
        }
        $cat = Menu::where($condition)->orderBy('order','asc')->get();
        if ($cat->count() > 0) {
            $cat->map(function($q) use($process_id) {
                $sub = $this->getSubMenuCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });
            return $cat;
        }
        return null;
    }

    /**
     * Get list sub category of certain article
     * 
     * @param int id of category where we search its sub
     * @param int id of current article should be ignored
     * @return Collection the list sub
     * @return null
     */
    private function getSubArticleCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        $condition[] = ['type', 0];
        if ($process_id !== null) {
            $condition[] = ['id', '<>', $process_id];
        }
        $cat = Category::where($condition)->get();
        if ($cat->count() > 0) {
            $cat->map(function($q) use($process_id) {
                $sub = $this->getSubArticleCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });
            return $cat;
        }
        return null;
    }

    /**
     * Get list sub category of certain product
     * 
     * @param int id of category where we search its sub
     * @param int id of current product should be ignored
     * @return Collection the list sub
     * @return null
     */
    private function getSubProductCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        $condition[] = ['type', 1];
        if ($process_id !== null) {
            $condition[] = ['id', '<>', $process_id];
        }
        $cat = Category::where($condition)->get();
        if ($cat->count() > 0) {
            $cat->map(function($q) use($process_id) {
                $sub = $this->getSubProductCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });
            return $cat;
        }
        return null;
    }

    /**
     * Get list available article
     * 
     * @param Request
     * @return Response
     */
    public function list_articles(Request $request){
        $dataView = [];
        $list_cat = null;
        $articles = null;

        $list_cat = $this->getSubArticleCategories($request->cat);
        $condition = [];
        if ($request->cat && $request->cat!=0) 
            $condition[] = ['cat', $request->cat];
        if ($request->keyword) 
            $condition[] = ['name', 'like', '%'.$request->keyword.'%'];

        $articles = Article::where($condition)
                                ->latest()
                                ->paginate(10);
        $dataView['list_cat'] = $list_cat;
        $dataView['keyword'] = $request->keyword;
        $dataView['article'] = $articles;
        return Theme::uses('visitors')->scope('menu.list-article', $dataView)->content();
    }

    public function list_products(Request $request){
        $dataView = [];
        $list_cat = null;
        $products = null;

        $list_cat = $this->getSubProductCategories($request->cat);
        $condition = [];
        if ($request->cat && $request->cat!=0) 
            $condition[] = ['cat', $request->cat];
        if ($request->keyword) 
            $condition[] = ['name', 'like', '%'.$request->keyword.'%'];

        $products = Product::where($condition)
                                ->latest()
                                ->paginate(10);
        $dataView['list_cat'] = $list_cat;
        $dataView['keyword'] = $request->keyword;
        $dataView['product'] = $products;
        return Theme::uses('visitors')->scope('menu.list-product', $dataView)->content();
    }

    /**
     * Delete an article category and its children
     * 
     * @param $id article_id
     * @return mixed
     */
    private function delete_child_cat($id) {
        if (Menu::find($id) == null)
            return;
        if (Menu::where('parent', $id)->count() > 0) {
            foreach (Menu::where('parent', $id)->get() as $key=>$value) {
                $this->delete_child_cat($value->id);
            }
        }
        Menu::find($id)->delete();
    }

    /**
     * Delete multi categories
     * 
     * @param Request
     * @return mixed
     */
    public function delete(Request $request) {
        $not_delete = '';
        foreach (explode(',', $request->id) as $key=>$value) {
            if ($this->validate_delete_child_cat(Menu::find($value)) != 0) {
                $this->delete_child_cat($value);
            }
            else {
                $not_delete .= $value.',';
            }    
        }
        if ($not_delete == '')
            die('0');
        else
            die($not_delete);
    }
     /**
     * Determine input category have menu in it/its child or not
     * 
     * @param Menu $cat
     * @return bool
     */
    private function validate_delete_child_cat(Menu $cat) {
        if ($cat->where('parent', $cat->id)->count() > 0) {
            foreach ($cat->where('parent', $cat->id)->get() as $key=>$value) {
                if ($this->validate_delete_child_cat($value) == 0) {
                    return 0;
                }
            }
        }
        return 1;
    }

    public function sortcat(Request $request){
        $cats = $request->sort;
        $order = array();
		foreach ($cats as $c) {
			$id = str_replace('cat_', '', $c);
			$order[] = Menu::find($id)->order;
        }
        sort($order);
		foreach ($order as $k => $v) {
            $menu = Menu::find(str_replace('cat_', '', $cats[$k]));
            $menu->order = $v;
            $menu->save();
		}
    }

    public function get_article(Request $request){
        $data = [];
        $data['article'] = Article::find($request->id);
        $data['article_cat'] = $data['article']->article_cat;
        return Response::json($data);
    }

    public function get_product(Request $request){
        $data = [];
        $data['product'] = Product::find($request->id);
        $data['product_cat'] = $data['product']->product_cat;
        return Response::json($data);
    }
}
