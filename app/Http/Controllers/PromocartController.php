<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promocart;
use Illuminate\Http\Request;

class PromocartController extends Controller
{
    //
    public function index(){
        $carts_promo = Promocart::orderBy('created_at','desc')->get();
        return view('admin.carts-promo',compact('carts_promo'));
    }
    public function create(){
        $products = Product::orderBy('created_at','desc')->get();
        return view('admin.add-cart-promo',compact('products'));
    }

    public function store(Request $request){
        $data = $request->all();
        if( $request->product){
            $data['product'] = json_encode($data['product']);
        }
        Promocart::create($data);
        return redirect('admin/cart-promo');
    }

    public function edit($id){
        $cart_promo = Promocart::find($id);
        $jsonData = json_decode($cart_promo->product, true);
        $array_designation = array();
        $array_id = array();
        foreach($jsonData as $product => $value){
           $product = Product::where('id',$value)->first();
           array_push($array_designation, $product->designation);
           array_push($array_id, $product->id);
        }
        $products = Product::whereNotIn('id',$jsonData)->get();

        return view('admin.edit-cart-promo',compact('cart_promo','array','products'));
    }

    public function destroy($id){
        $cart_promo = Promocart::find($id);
        $cart_promo->delete();
        return redirect('admin/cart-promo');
    }
    public function cartDetail($id){
     $cart_promo = Promocart::find($id);
     $jsonData = json_decode($cart_promo->product, true);
     $array = array();
     foreach($jsonData as $product => $value){
        $product = Product::where('id',$value)->first();
        array_push($array, $product->designation);
     }

     return view('admin.modal-cart-promo',compact('cart_promo','array'));
    }
}
