<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Productcategory;
use App\Models\Productline;
use App\Models\Promopack;
use App\Models\Promopackline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $hasFile = $request->hasFile('photo');
        $product = new Product();
        $product->designation = $request->designation;
        $product->long_description = $request->description;
        $product->short_description = $request->short_description;
        $product->slug = str::slug($request->designation);
        $product->is_brouillon = 0;
        $product->save();
        $productcategory = new Productcategory();
        $productcategory->product_id = $product->id;
        $productcategory->category_id = 7;
        $productcategory->save();

        if($hasFile){
            $destination = 'public/images/products';
            $path = $request->file('photo')->store($destination);
            $storageName = basename($path);
            $image = new Image();
            $image->lien = $storageName;
            $image->type = 1;
            $product->images()->save($image);
        }

        $productline = new Productline();
        $productline->product_id = $product->id;
        $productline->price = $request->price;
        $productline->promo_price = $request->price_promo;
        $productline->qte = $request->qte;
        $productline->save();

        $pack_promo = new Promopack();
        $pack_promo->product_id = $product->id;
        $pack_promo->designation = $request->designation;
        $pack_promo->price = $request->price;
        $pack_promo->price_promo = $request->price_promo;
        $pack_promo->qte = $request->qte;
        $pack_promo->date_debut = $request->date_debut;
        $pack_promo->date_fin = $request->date_fin;
        $pack_promo->description = $request->description;

        if($hasFile){
            $destination = 'public/images/packpromo';
            $path = $request->file('photo')->store($destination);
            $storageName = basename($path);
            $pack_promo->photo = $storageName;

        }
        $pack_promo->save();
        foreach($request->products as $product){
            $packline = new Promopackline();
            $packline->promopack_id = $pack_promo->id;
            $packline->product_id = $product;
            $packline->save();
        }

        return redirect('admin/pack-promo');
    }

    public function edit($id){
        $pack_promo = Promopack::find($id);
        $array = array();
        $packlines = Promopackline::where('promopack_id',$id)->get();
        foreach($packlines as $packline){
           array_push($array , $packline->product_id);
        }
        $products = Product::whereNotIn('id',$array)->orderBy('created_at','desc')->get();
         return view('admin.edit-pack-promo',compact('products','packlines','pack_promo'));
    }

    public function update(Request $request , $id){
        $pack_promo = Promopack::find($id);
        Storage::disk('public')->delete('images/packpromo/'.$pack_promo->photo);
        $packlines = Promopackline::where('promopack_id',$id)->get();
        foreach($packlines as $packline){
           $packline->delete();
        }
        $pack_promo->designation = $request->designation;
        $pack_promo->price = $request->price;
        $pack_promo->price_promo = $request->price_promo;
        $pack_promo->qte = $request->qte;
        $pack_promo->date_debut = $request->date_debut;
        $pack_promo->date_fin = $request->date_fin;
        $pack_promo->description = $request->description;

        $hasFile = $request->hasFile('photo');
        if($hasFile){
            $destination = 'public/images/packpromo';
            $path = $request->file('photo')->store($destination);
            dd($path);
            $storageName = basename($path);
            $pack_promo->photo = $storageName;

        }
        $pack_promo->save();
        foreach($request->products as $product){
            $packline = new Promopackline();
            $packline->promopack_id = $pack_promo->id;
            $packline->product_id = $product;
            $packline->save();
        }

        return redirect('admin/pack-promo');
    }

    public function destroy($id){
        $pack_promo = Promopack::find($id);
        $packlines = Promopackline::where('promopack_id',$id)->get();
        foreach($packlines as $packline){
           $packline->delete();
        }
        $pack_promo->delete();
        return redirect('admin/pack-promo');
    }
    public function packDetail($id){
        $pack = Promopack::find($id);
        $packlines= Promopackline::where('promopack_id',$id)->get();
        return view('admin.modal-pack-detail',compact('packlines','pack'));
    }
}
