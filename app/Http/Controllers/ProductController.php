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

        for($i=0 ; $i<count($request->qtes) ; $i++){
            $productline = new Productline();
            $productline->product_id = $product->id;
            $productline->attributeline_id = $request->values[$i];
            $productline->attribute_id = $request->a[$i];
            $productline->qte = $request->qtes[$i];
            $productline->price = $request->prices[$i];
            $productline->promo_price = $request->promos[$i];
            $productline->status = $request->status;
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
        return redirect('dashboard-admin/products');
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
}
