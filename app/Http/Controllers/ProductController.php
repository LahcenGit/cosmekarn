<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attributeline;
use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Product;
use App\Models\Productcategory;
use App\Models\Productline;
use App\Models\Relatedproduct;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index(){
     $products = Product::all();
     return view('admin.products',compact('products'));
    }

    public function create(){
        $categories = Category::whereNull('parent_id')
                                ->with('childCategories')
                                ->orderby('description', 'asc')
                                ->get();
        $products = Product::all();
        $attributes = Attribute::all();
        return view('admin.add-product',compact('categories','products','attributes'));
    }
    
    

    public function store(Request $request){
        $product = new Product();
        $product->designation = $request->designation;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->point = $request->point;
        $product->slug = str::slug($request->designation);
        if($request->brouillon == '1'){
            $product->is_brouillon = 1;
        }
        else{
            $product->is_brouillon = 0;
        }

        if($request->date){
         $product->created_at = $request->date;
        }
        $product->save();

        //product has no attribute
        if($request->check != 'oui'){
            //test if there is a single variation
            if($request->variation == 0){
                $productline = new Productline();
                $productline->product_id = $product->id;
                $productline->qte = $request->qte;
                $productline->price = $request->price;
                $productline->promo_price = $request->promo;
                $productline->status = $request->status;
                $productline->save();
            }
            else{
                $productline = new Productline();
                $productline->product_id = $product->id;
                $productline->qte = $request->qte;
                $productline->price = $request->price;
                $productline->promo_price = $request->promo;
                $productline->attributeline_id = $request->variation;
                $productline->attributeline_id = $request->value;
                $productline->status = $request->status;
                $productline->save();
            }
        }
        //product has many attribute
        else{

        for($i=0 ; $i<count($request->as) ; $i++){
            $productline = new Productline();
            $productline->product_id = $product->id;
            $productline->attributeline_id = $request->values[$i];
            $productline->attribute_id = $request->as[$i];
            $productline->qte = $request->qtes[$i];

            if($request->price){
                $productline->price = $request->price;
            }
            else{
                $productline->price = $request->prices[$i];
            }
            if($request->promo){
                $productline->promo_price = $request->promo;
            }
            else{
                $productline->promo_price = $request->promos[$i];
            }

            $productline->status = $request->status;

            if($request->icons){
                $destination = 'public/icones/productlines';
                $path = $request->icons[$i]->store($destination);
                $storageName = basename($path);
                $productline->attribute_icone = $storageName;
            }


            if($request->images){
                $destination = 'public/images/productlines';
                $path = $request->images[$i]->store($destination);
                $storageName = basename($path);
                $productline->attribute_image = $storageName;
             }
            $productline->save();
        }
    }
       //product has related products
        if($request->relatedproducts){
        foreach($request->relatedproducts as $relatedproduct){
            $productR = new Relatedproduct();
            $productR->product_id = $product->id;
            $productR->added_product_id = $relatedproduct;
            $productR->save();
        }
    }
       //categories product
        foreach($request->categories as $category){

            $categoryproduct = new Productcategory();
            $categoryproduct->product_id = $product->id;
            $categoryproduct->category_id= $category;
            $categoryproduct->save();
        }
        // product images
        //first_image
        $hasFile = $request->hasFile('photoPrincipale');
        $hasFileTwo = $request->hasFile('photos');
        if($hasFile){
                $destination = 'public/images/products';
                $path = $request->file('photoPrincipale')->store($destination);
                $storageName = basename($path);
                $image = new Image();
                $image->lien = $storageName;
                $image->type = 1;
                $product->images()->save($image);
            }
        // secondary images
        if($hasFileTwo){
            foreach($request->file('photos') as $file){
                $destination = 'public/images/products';
                $path = $file->store($destination);
                $storageName = basename($path);
                $image = new Image();
                $image->lien = $storageName;
                $image->type = 2;
                $product->images()->save($image);
            }
        }
        return redirect('admin/products');
    }



    public function edit($id){
        
        $array_checked = array();
        $product = Product::find($id);
        $categories = Category::whereNull('parent_id')
                                ->with('childrenCategories')
                                ->orderby('description', 'asc')
                                ->get();
        $categories_checked = Productcategory::where('product_id', $product->id)->get();
        //make an arrray to checked category 
        foreach($categories_checked as $checked){
           
            array_push($array_checked,$checked->category_id);
        }
        $array_checked = json_encode($array_checked);
        $images = Image::where('product_id', $id)->where('type',2)->get();



        $image_preload_p = Image::where('product_id', $id)->where('type',1)
        ->select('id', DB::raw("concat('https://www.licbplus.com.dz/newsite/public/storage/images/products/', lien) as src"))
        ->get();

        $images_preload = Image::where('product_id', $id)->where('type',2)
        ->select('id', DB::raw("concat('https://www.licbplus.com.dz/newsite/public/storage/images/products/', lien) as src"))
        ->get();

        $all_productlines = Productline::all();
        $attributes = Attribute::all();
       // $marks = Mark::all();
        $productlines = Productline::where('product_id',$id)->get();
           
        return view('admin.edit-product',compact('product','categories','attributes','marks','productlines','all_productlines','images','array_checked','images_preload','image_preload_p'));
    }



    public function getAttribute($id){

        $attributes = Attributeline::where('attribute_id',$id)->get();
        return $attributes;

    }



    public function destroy($id){
        $product = Product::find($id);
        $images = Image::where('product_id', $id)->get();
        foreach($images as $image){
         File::delete('storage/images/products/'.$image->lien);
        }
        $productlines = Productline::where('product_id',$id)->get();
        foreach($productlines as $productline){
         $productline->delete();
        }

        $product->delete();
        return redirect('admin/products');
    }

    public function showModal(){
        $attributes = Attribute::all();
        return view('admin.modal-add-attribute',compact('attributes'));
    }

    public function addAttribute(Request $request){
        if($request->type == 0){
            $attribute = new Attribute();
            $attribute->value = $request->attr;
            $attribute->save();
        }
        else{
            $attributeline = new Attributeline();
            $attributeline->attribute_id = $request->type;
            $attributeline->value = $request->attr;
            $attributeline->save();
        }
        $attributes = Attribute::all();
        return $attributes;
    }


    public function detailProduct($slug){
        $product = Product::where('slug',$slug)->first();
        $first_image = Image::where('product_id',$product->id)->where('type',1)->first();
        $countproductlines = Productline::where('product_id',$product->id)->count();

        //product has many attribute
        if($countproductlines > 1){
           // recover the minimum price
           $min_price = Productline::where('product_id',$product->id)->min('price');
           //recover the minimum price_promo
           $min_price_promo = Productline::where('product_id',$product->id)->min('promo_price');
           //recover the productlines groupby attribute
           $product_lines = Productline::with('attributeLine')->where('product_id',$product->id)
                                        ->orderBy('price','asc')
                                        ->get()
                                        ->groupBy('attribute_id');

            $productlines = Productline::with('attributeLine')->where('product_id',$product->id)
                            ->orderBy('price','asc')
                            ->get();
            //first productline
            $product_line = Productline::where('product_id',$product->id)->first();
            $attributes = null;

            $images = $product->images;
            $images_attributes = $product->productlines;

            if($images){
                $secondary_images = $images->where('type',2);
            }


           }
          //product has no attribute
        else{
           $images = $product->images;
           $secondary_images = $images->where('type',2);
           $min_price = null;
           $min_price_promo = null;
           $product_line = Productline::where('product_id',$product->id)->first();
           $productlines = null;
           $attributes = null;
           $product_lines = null;
           $images_attributes = null;
        }
        $categories = Category::where('parent_id',null)->limit('5')->get();
        // 3 new products
        $new_products = Product::orderBy('created_at','desc')->where('id','!=',$product->id)->limit('3')->get();
        $category = Productcategory::where('product_id',$product->id)->first();
        $related_products = Productcategory::where('category_id',$category->category_id)->where('product_id','!=',$product->id)->get();

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
        $comments = Comment::where('product_id',$product->id)->get();
        $count_comment = Comment::where('product_id',$product->id)->count();
        $nbr_comment = 0;
        if(Auth::user()){
            $nbr_comment = Comment::where('product_id',$product->id)->where('user_id',Auth::user()->id)->count();
        }
        return view('detail-product',compact('product','product_lines','first_image','min_price','attributes','productlines','min_price_promo','countproductlines','categories','new_products','related_products','product_line','secondary_images','images','images_attributes','cartitems','nbr_cartitem','total','comments','count_comment','nbr_comment'));
    }


    public function getProduct($id){
        $product = Product::find($id);
        $countproductlines = Productline::where('product_id',$product->id)->count();
        if($countproductlines >1){
            $productlines = null;
        }
        else{
            $productlines = Productline::where('product_id',$product->id)->first();
        }
        $data = array(
            "countproductlines" => $countproductlines,
            "productlines" => $productlines
          );
        return $data;
    }

}
