<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Theme;
// use Auth;
use Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    /**
     * Show cart
     * 
     * @return Reponse
     */
    public function show() {
        $dataView = [];
        $title = 'Cart';
        // $userId = Auth::id();
        $images = [];

        // add single condition on a cart bases
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT',
            'type' => 'tax',
            'target' => 'subtotal',
            'value' => '12.5%',
            'attributes' => array( // attributes field is optional
                'description' => 'Value added tax',
                'more_data' => 'none'
            )
        ));
        Cart::condition($condition);
        
        // if ($userId) {
        //     $dataView['items'] = Cart::session($userId)->getContent()->each(function($item) use(&$images) {
        //         $product = Product::find($item->id);
        //         $images[$item->id] = $product->image;
        //     });
        //     Cart::session($userId)->condition($condition); // for a speicifc user's cart
        // }
        // else {
            $dataView['items'] = Cart::getContent()->each(function($item) use(&$images) {
                $product = Product::find($item->id);
                $images[$item->id] = $product->image;
            });
        // }
        $dataView['title'] = $title;
        $dataView['images'] = $images;
        return Theme::uses()->scope('shopping-cart', $dataView)->setTitle($title)->render();
    }

    /**
     * Add new product to cart
     * 
     * @param Request
     */
    public function add(Request $request)
    {
        // $userId = Auth::id(); // get this from session or wherever it came from
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $qty = $request->qty;
        $customAttributes = [
            'size' => $request->size
        ];
        // if ($userId)
        //     \Cart::session($userId)->add($id, $name, $price, $qty, $customAttributes);
        // else
            \Cart::add($id, $name, $price, $qty, $customAttributes);
    }

    /**
     * Remove a product from cart
     * 
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        // $userId = Auth::id(); // get this from session or wherever it came from
        // if ($userId) {
        //     \Cart::session($userId)->remove($request->id);
        //     return response(array(
        //         'success' => true,
        //         'data' => $request->id,
        //         'message' => "cart item {$request->id} removed."
        //     ),200,[]);
        // }
        // else {
            \Cart::remove($request->id);
            return response(array(
                'success' => true,
                'data' => $request->id,
                'message' => "cart item {$request->id} removed."
            ),200,[]);
        // }
    }

    /**
     * Get order details
     * 
     * @return Response
     */
    public function details()
    {
        // $userId = Auth::id(); // get this from session or wherever it came from
        // if ($userId) {
        //     return response(array(
        //         'success' => true,
        //         'data' => array(
        //             'total_quantity' => \Cart::session($userId)->getTotalQuantity(),
        //             'sub_total' => \Cart::session($userId)->getSubTotal(),
        //             'total' => \Cart::session($userId)->getTotal(),
        //         ),
        //         'message' => "Get cart details success."
        //     ),200,[]);
        // }
        // else {
            return response(array(
                'success' => true,
                'data' => array(
                    'total_quantity' => \Cart::getTotalQuantity(),
                    'sub_total' => \Cart::getSubTotal(),
                    'total' => \Cart::getTotal(),
                ),
                'message' => "Get cart details success."
            ),200,[]);
        // }
    }

    /**
     * Update order
     * 
     * @param Request
     */
    public function update(Request $request) {
        // $userId = Auth::id(); // get this from session or wherever it came from
        // if ($userId) {
        //     \Cart::session($userId)->update($request->id, array(
        //         'quantity' => $request->qty,
        //     ));
        //     return response(array(
        //         'success' => true,
        //         'data' => $request->id,
        //         'message' => "cart item {$request->id} updated."
        //     ),200,[]);
        // }
        // else {
            
            \Cart::update($request->id, array(
                'quantity' => $request->qty,
            ));
            return response(array(
                'success' => true,
                'data' => $request->id,
                'message' => "cart item {$request->id} updated."
            ),200,[]);
        // }
    }

    /**
     * Show checkout page
     * 
     * @param Request
     * @return Response
     */
    public function checkout(Request $request) {
        $dataView = [];

        $title = 'Checkout';
        $dataView['title'] = $title;
        return Theme::scope('checkout', $dataView)->setTitle($title)->render();
    }

    /**
     * Store order
     * 
     * @param Request
     */
    public function store(Request $request) {
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->phone =  $request->phone;
        $order->content = $request->note?$request->note:'';
        $order->status = 'unhandle';
        $order->save();

        foreach (Cart::getContent() as $item) {
            $detail = new OrderDetail();
            $detail->order_id = $order->id;
            $detail->product_id = $item->id;
            $detail->quantity = $item->quantity;
            $detail->price = $item->price;
            $detail->save();
        }
        Cart::clear();
        return response(array(
            'success' => true,
            'message' => "cart order created."
        ),200,[]);
    }

}
