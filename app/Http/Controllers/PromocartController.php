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
        $products = Product::orderBy('created_at','desc')->whereNotIn('id', function ($query) {
            $query->select('product_id')->from('promopacks');
            })->get();
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
        if($cart_promo->type == 1){
            $jsonData = json_decode($cart_promo->product, true);
            $array = array();
            $array_id = array();
            foreach($jsonData as $product => $value){
               $product = Product::where('id',$value)->first();
               array_push($array, $product);

            }
            $products = Product::orderBy('created_at','desc')->whereNotIn('id',$jsonData)->whereNotIn('id', function ($query) {
                                $query->select('product_id')->from('promopacks');
                                })->get();
        }
        else{
            $products = Product::orderBy('created_at','desc')->whereNotIn('id', function ($query) {
                $query->select('product_id')->from('promopacks');
                })->get();
            $array = null;
        }


        return view('admin.edit-cart-promo',compact('cart_promo','array','products'));
    }

    public function update(Request $request , $id){
        $cart_promo = Promocart::find($id);
        if( $request->product){
            $cart_promo->product = json_encode($request['product']);
        }
        $cart_promo->type = $request->type;
        $cart_promo->format = $request->format;
        $cart_promo->value = $request->value;
        $cart_promo->mt_panier = $request->mt_panier;
        $cart_promo->date_debut = $request->date_debut;
        $cart_promo->date_debut = $request->date_fin;
        $cart_promo->save();
        return redirect('admin/cart-promo');
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
