<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderline;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){
        $orders = Order::all()->reverse();
        return view('admin.orders',compact('orders'));
    }

    public function edit($id){
        $order = Order::find($id);
        return view('admin.edit-order',compact('order'));
        }

    public function update(Request $request , $id){
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
        return redirect('admin/orders');
    }

    public function orderDEtails($id){
        $orderlines = Orderline::where('order_id',$id)->get();
        $total = 0;
        foreach($orderlines as $orderline){
            $total = $total + $orderline->total;
        }
        return view('admin.modal-order-details',compact('orderlines','total'));
    }
}
