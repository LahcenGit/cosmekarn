<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        if(Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            if($cart){
            $cartitems = $cart->cartitems;
            $nbr_cartitem = $cart->cartitems->count();
            $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$cart->id)->first();
            }
            else{
                $cartitems = null;
                $nbr_cartitem = 0;
                $total = 0;
            }
        }
        else{
        $cart= session('cart_id');
        $cartitems = Cartitem::where('cart_id',$cart)->get();
        $nbr_cartitem = Cartitem::where('cart_id',$cart)->count();
        $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$cart)->first();
        }


        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('customer.dashboard-customer',compact('cart','cartitems','nbr_cartitem','total','orders'));

    }
}
