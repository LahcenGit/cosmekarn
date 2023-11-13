<?php

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Favoriteline;
use Illuminate\Support\Facades\Auth;

if(Auth::user()){
    $cart = Cart::where('user_id',Auth::user()->id)->first();
    $cart_session = session('cart_id');
    if ($cart_session) {
        $cartitems_session = Cartitem::where('cart_id', $cart_session)->get();

        foreach ($cartitems_session as $cartitem_session) {
            // Vérifier si le produit existe déjà dans le panier de l'utilisateur
            $existingCartItem = $cart->cartitems()->where('productline_id', $cartitem_session->productline_id)->first();

            if ($existingCartItem) {
                // Si le produit existe, augmenter la quantité
                $existingCartItem->qte += $cartitem_session->qte;
                $existingCartItem->price =  $cartitem_session->qte * $cartitem_session->price;
                $existingCartItem->save();
            } else {
                // Sinon, créer un nouvel élément dans le panier de l'utilisateur
                $cartitem_session->cart_id = $cart->id;
                $cartitem_session->save();
            }
        }
    }
    session()->forget('cart');
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
