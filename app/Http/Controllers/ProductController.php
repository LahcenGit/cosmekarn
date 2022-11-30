<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attributeline;
use App\Models\Category;
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

class ProductController extends Controller
{
    //
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
        $productline = new Productline();
        $productline->product_id = $product->id;
        $productline->qte = $request->qte;
        $productline->price = $request->price;
        $productline->promo_price = $request->promo;
        $productline->status = $request->status;
        $productline->save();
        }
        //product has many attribute
        else{

        for($i=0 ; $i<count($request->a) ; $i++){
            $productline = new Productline();
            $productline->product_id = $product->id;
            $productline->attributeline_id = $request->values[$i];
            $productline->attribute_id = $request->a[$i];
            $productline->qte = $request->qtes[$i];
            $productline->price = $request->prices[$i];
            $productline->promo_price = $request->promos[$i];
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


    public function getAttribute($id){
        $attributes = Attributeline::where('attribute_id',$id)->get();
        return $attributes;

    }



    public function destroy($id){
        $product = Product::find($id);
        $image = Image::where('product_id', $id)->where('type',1)->first();

         File::delete('storage/images/products/'.$image->lien);

        $product->delete();
        return redirect('dashboard-admin/products');
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
           $images_attributes = null;
        }
        $categories = Category::where('parent_id',null)->limit('5')->get();
        // 3 new products
        $new_products = Product::orderBy('created_at','desc')->where('id','!=',$product->id)->limit('3')->get();
        $category = Productcategory::where('product_id',$product->id)->first();
        $related_products = Productcategory::where('category_id',$category->category_id)->where('product_id','!=',$product->id)->get();

        return view('detail-product',compact('product','first_image','min_price','attributes','productlines','min_price_promo','countproductlines','categories','new_products','related_products','product_line','secondary_images','images','images_attributes'));
    }
}
