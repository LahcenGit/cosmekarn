<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use Illuminate\Http\Request;
use TheHocineSaad\LaravelAlgereography\Models\Wilaya;

class CheckoutController extends Controller
{
    public function index(Request $request){

        $cart = Cart::find($request->cart_id);
        $cartitems = Cartitem::where('cart_id',$request->cart_id)->get();
        $nbr_cartitem = $cartitems->count();
        $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$request->cart_id)->first();


        $wilayas = Wilaya::all();
        return view('checkout',compact('cartitems','nbr_cartitem','total','wilayas'));

    }
}
