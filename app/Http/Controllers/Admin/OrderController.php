<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Theme;

class OrderController extends Controller
{
    /**
     * Show list order
     * 
     * @param Request
     * @return Response
     */ 
    public function index(Request $request) {
        $dataView = [];
        $condition = [];

        $condition[] = ['name', 'like', '%'.$request->f_name.'%'];
        if ($request->status === 'unhandle') {
            $title = 'Unhandle Orders';
            $condition[] = ['status', 'unhandle'];
        }
        else if ($request->status === 'proceed') {
            $title = 'Proceeding Orders';
            $condition[] = ['status', 'proceed'];
        }
        else if ($request->status === 'success') {
            $title = 'Successful Orders';
            $condition[] = ['status', 'success'];
        }
        else if ($request->status === 'error') {
            $title = 'Error Orders';
            $condition[] = ['status', 'error'];
        }
        else {
            abort(404);
        }
        $orders = Order::where($condition)->latest()->paginate(8);
        $dataView['orders'] = $orders;
        if ($request->ajax()) {
            return Theme::uses('visitors')->scope('order.list',$dataView)->content();
        }
        $dataView['title'] = $title;
        $dataView['type'] = $request->status;
        return Theme::uses('visitors')->scope('order.index', $dataView)->setTitle($title)->render();
    }

    /**
     * Show order detail
     * 
     * @param Request
     * @return Response
     */
    public function detail(Request $request) {
        $dataView = [];
        
        $order = Order::find($request->id);
        $order_items = OrderDetail::where('order_id',$request->id)->get()->map(function($q) {
            $name = Product::find($q->product_id)->name;
            $q->name = $name;
            return $q;
        });
        $dataView['order'] = $order;
        $dataView['order_items'] = $order_items;
        return Theme::uses('visitors')->scope('order.detail', $dataView)->setTitle('Order Detail')->render();
    }

    /**
     * Change order to [unhandle, proceed, success, error]
     * 
     * @param \Request
     */
    public function changefield(Request $request) {
        $order = Order::find($request->id);
        $order->status = $request->field;
        $order->save();
        return response(array(
            'success' => true,
            'message' => "status order updated."
        ),200,[]);
    }

    /**
     * Delete an order or multi orders
     * 
     * @param $id the id number of order(s)
     */
    public function delete(Request $request) {
        $order = Order::find(explode(',', $request->id));
        foreach($order as $key=>$value) {
            $value->delete();
        }
    }

}
