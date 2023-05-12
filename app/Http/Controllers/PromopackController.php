<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promopack;
use App\Models\Promopackline;
use Illuminate\Http\Request;

class PromopackController extends Controller
{
    //
    public function index(){
        $packs_promo = Promopack::orderBy('created_at','desc')->get();
        return view('admin.packs-promo',compact('packs_promo'));
    }
    public function create(){
        $products = Product::orderBy('created_at','desc')->get();
        return view('admin.add-promopack',compact('products'));
    }

    public function store(Request $request){
        $pack_promo = new Promopack();
        $pack_promo->designation = $request->designation;
        $pack_promo->price = $request->price;
        $pack_promo->price_promo = $request->price_promo;
        $pack_promo->qte = $request->qte;
        $pack_promo->date_debut = $request->date_debut;
        $pack_promo->date_fin = $request->date_fin;
        $pack_promo->description = $request->description;
        $pack_promo->save();
        foreach($request->products as $product){
            $packline = new Promopackline();
            $packline->promopack_id = $pack_promo->id;
            $packline->product_id = $product;
            $packline->save();
        }

        return redirect('admin/pack-promo');
    }
    public function packDetail($id){
        $pack = Promopack::find($id);
        $packlines= Promopackline::where('promopack_id',$id)->get();
        return view('admin.modal-pack-detail',compact('packlines','pack'));
    }
}
