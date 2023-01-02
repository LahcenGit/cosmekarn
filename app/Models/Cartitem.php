<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    use HasFactory;

    public function productline(){
        return $this->belongsTo(Productline::class,'productline_id');
    }

    public function getImage(){
        $productline = Productline::where('id',$this->productline_id)->first();
        $image = Image::where('product_id',$productline->product_id)->where('type',1)->first();
        return $image;
    }

    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
}

