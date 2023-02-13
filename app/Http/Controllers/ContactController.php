<?php

namespace App\Http\Controllers;

use App\Mail\MailContact;
use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function index(){
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
        return view('contact',compact('cartitems','nbr_cartitem','total','categories'));

    }
    public function store(Request $request){
        Mail::to('benosmanhind@gmail.com')->send(new MailContact($request));
           return 1;
       }
}
