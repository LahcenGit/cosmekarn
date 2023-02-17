<?php

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

if(Auth::user()){
    $cart = Cart::where('user_id',Auth::user()->id)->first();
    $cartitems = $cart->cartitems;

    if($cartitems ){
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
$categories = Category::where('parent_id',null)->orderby('designation', 'asc')->get();

?>