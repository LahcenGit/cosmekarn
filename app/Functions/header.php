<?php

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Favoriteline;
use Illuminate\Support\Facades\Auth;

if(Auth::user()){
    $cart = Cart::where('user_id',Auth::user()->id)->first();
    $cart_id = $cart->id;
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


    $favorite = Favorite::where('user_id',Auth::user()->id)->first();
    $favorite_id = $favorite->id;
    $favoritelines = Favoriteline::where('favorite_id',$favorite->id)->get();
    $nbr_favoritelines = Favoriteline::where('favorite_id',$favorite->id)->count();
    $categories = Category::where('parent_id',null)->orderby('designation', 'asc')->get();


}
else{
    $cart_id = session('cart_id');
    $cartitems = Cartitem::where('cart_id',$cart_id)->get();
    $nbr_cartitem = Cartitem::where('cart_id',$cart_id)->count();
    $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$cart_id)->first();

    $favorite = session('favorite_id');
    if($favorite){
        $favoritelines = Favoriteline::where('favorite_id',$favorite->id)->get();
        $nbr_favoritelines = Favoriteline::where('favorite_id',$favorite->id)->count();
    }
    else{
        $favoritelines = null;
        $nbr_favoritelines = 0;
    }
    $categories = Category::where('parent_id',null)->orderby('designation', 'asc')->get();

}

?>
