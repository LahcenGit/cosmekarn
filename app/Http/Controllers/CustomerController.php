<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Orderline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        include(app_path() . '\Functions\header.php');
        $orders = Order::where('user_id',Auth::user()->id)->get();

        return view('customer.dashboard-customer',compact('cart_id','cartitems','nbr_cartitem','total','orders','categories','favoritelines','nbr_favoritelines'));

    }

    public function orderDetail($id){
        include(app_path() . '\Functions\header.php');
        $order = Order::find($id);
        $total_order = $order->total;
        $code = $order->code;
        $orderlines = Orderline::where('order_id',$id)->get();

        return view('customer.detail-order',compact('orderlines','cart','cartitems','nbr_cartitem','total','total_order','code','categories','favoritelines','nbr_favoritelines'));
    }
}
