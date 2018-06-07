<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MenuCat;
use Auth;
use Theme;

class MenuCatController extends Controller
{
    /**
     * Show list menu category
     * 
     * @param Request
     * @return Response
     */
    public function index(Request $request){
        $categories = MenuCat::latest()->get();
        $dataView = [];

        $dataView['categories'] = $categories;
        return Theme::uses('visitors')->scope('menu-cat.index', $dataView)->setTitle('List Menu')->render();
    }

    /**
     * Add or edit menu category
     */
    public function detail(Request $request){
        $category = MenuCat::find($request->id);
        if(!$category){
            $category = new MenuCat;
        }
        $dataView = [];
        $dataView['saved'] = 0;
        if ($request->isMethod('post')) {
            $category->name = $request->name;
            $category->public = isset($request->public)?1:0;
            $category->updated_by = Auth::id();
            $category->save();
            $dataView['saved'] = 1;
        }
        $dataView['category'] = $category;
        return Theme::uses('visitors')->scope('menu-cat.detail', $dataView)->setTitle('Menu')->render();
    }

    /**
     * Delete a category
     * @param Request
     */
    public function delete(Request $request){
        $cat = MenuCat::find($request->id);
        $cat->delete();
        die('1');
    }
}
