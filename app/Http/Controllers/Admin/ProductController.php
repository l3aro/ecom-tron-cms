<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\UploadHandler;
use App\Libraries\UploadFile;
use App\Models\ProductImage;
use App\Models\Productcat;
use App\Models\Product;
use Auth;
use Theme;

class ProductController extends Controller
{
    /**
     * Show list of products
     * 
     * @param \Request  $request
     * @return \Response
     */
    public function index(Request $request) {
        $dataView = [];
        $products = null;
        $condition = [];

        $condition[] = ['name', 'like', '%'.$request->f_name.'%'];

        $products = Product::where($condition)->orderBy('created_at','desc')->paginate(8);
        $dataView['products'] = $products;

        if ($request->ajax()) {
            return Theme::uses('visitors')->scope('product.list',$dataView)->content();
        }
        return Theme::uses('visitors')->scope('product.index',$dataView)->render();
    }

    /**
     * Add new or edit an exist product
     * 
     * @param Request $request
     * @return Response
     */
    public function detail(Request $request){
        $slug_exists = 0;
        $product = Product::find($request->id);
        if (!$product) $product = new Product;
        $image = '';
        $dataView = [];
        $dataView['saved'] = 0;
        $dataView['copy'] = $request->act=='copy'?1:0;
        if ($request->act == 'copy'){
            $product->id = null;
            $product->public = 0;
            $product->highlight = 0;
            $product->new = 0;
            }
        if ($request->isMethod('post')) {
            if($request->file('image') && $request->file('image')->isValid()){
                $folder = public_path('media/product/');
                $image = UploadFile::uploadImage($_FILES['image'], $folder, $product->image);
            } else {
                if ($request->act == 'copy'){
                    if ($product->image){
                        $folder = public_path('media/product/');
                        $ext = UploadFile::getExtension($product->image);
                        list($usec, $sec) = explode(".", microtime(true));
                        $image = $usec . $sec . '.' . $extension;
                        if (file_exists($folder.$product->image)) copy ($folder.$product->image, $folder.$image);
                        if (file_exists($folder.'tb/'.$product->image)) copy ($folder.'tb/'.$product->image, $folder.'tb/'.$image);
                    } else {
                        $image = '';
                    }
                } else {
                    $image = $product->image;
                }
            }
            $product->name = $request->name;
            $product->price = (float)$request->price;
            $product->cat = (int)$request->cat;
            $product->image = $image?$image:'';
            $product->product_code = $request->product_code;
            $product->unit = $request->unit;
            $product->des = $request->des?$request->des:'';
            $product->detail = $request->detail?$request->detail:'';
            $product->page_title = $request->page_title?$request->page_title:'';
            $product->public = isset($request->public)?1:0;
            $product->highlight = isset($request->highlight)?1:0;
            $product->new = isset($request->new)?1:0;
            $product->updated_by = Auth::id();
            $product->save();

            if ($request->slug) {
                $slug = $request->slug;
                if (Product::where([['slug',$slug],['id','<>',$product->id]])->first()) {
                    $product->slug = $slug;
                    $slug_exists = 1;
                    $dataView['slug_exists'] = $slug_exists;
                    $dataView['product'] = $product;
                    $productcat = new Productcat();
                    $dataView['category_options'] = $productcat->GetOptions($product->cat);
                    $dataView['productImages'] = ProductImage::where('product_id', $request->id)->latest()->get();
                    return Theme::uses('visitors')->scope('product.detail', $dataView)->render();
                }
            }
            else {
                $product->save();
                $slug = str_slug($request->name."-".$product->id, '-');
            }
            $product->slug = $slug;
            $product->save();
            $dataView['saved'] = 1;
        }
        $dataView['slug_exists'] = $slug_exists;
        $dataView['product'] = $product;
        // $dataView['list_cat'] = $list_cat;
        $dataView['productImages'] = ProductImage::where('product_id', $request->id)->latest()->get();
    	return Theme::uses('visitors')->scope('product.detail', $dataView)->render();
    }

    /**
     * Delete product avatar
     * 
     * @param Request
     */
    public function deleteavatar(Request $request, $process_id = null){
        $id = $request->id;
        if ($process_id !== null)
            $id = $process_id;
        $record = Product::find($id);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/media/product/';
        if (file_exists($folder . $record->image))	unlink($folder . $record->image);
        if (file_exists($folder . 'tb/' . $record->image))	unlink($folder . 'tb/' . $record->image);
        $record->image = '';
        $record->save();
    }
    
    /**
     * Delete product image
     * 
     * @param Request
     */
    public function deleteproductimage(Request $request){
        $id = $request->id;
        $record = Productimage::find($id);
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/media/product/' . $record->product_id;
        if (file_exists($folder . $record->image))	unlink($folder . $record->image);
        if (file_exists($folder . 'tb/' . $record->image))	unlink($folder . 'tb/' . $record->image);
        $record->image = '';
        $record->delete();
    }

    /**
     * Delete a product or multi products
     * 
     * @param Request
     */
    public function delete(Request $request){
        $product = Product::find(explode(',', $request->id));
        foreach($product as $key=>$value) {
            if ($value->image)
                $this->deleteavatar($request, $value->id);
            $value->delete();
        }
    }

    /**
     * Change an attribute of [public, highlight, new] to true or false
     * 
     * @param \Request
     */
    public function changefield(Request $request) {
        $field = $request->field;
        $product = Product::find($request->id);
        $product->$field = $request->p?'0':'1';
        $product->save();
        die($request->p);
    }
}
