<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    use HasFactory;

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function getPrice(){
        $price = Productline::where('product_id',$this->product_id)->min('price');
        return $price;
    }
    public function getPricePromo(){

        $price_promo = Productline::where('product_id',$this->product_id)->min('promo_price');
        if($price_promo){
            return $price_promo;
        }
        else{
            return null;
        }

    }
}
