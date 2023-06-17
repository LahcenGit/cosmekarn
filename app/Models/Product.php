<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category(){
        return $this->hasOne(Category::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function productlines()
    {
        return $this->hasMany(Productline::class);
    }
    public function packlines()
    {
        return $this->hasMany(Productline::class);
    }
    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }

    public function getPrice(){
        $price = Productline::where('product_id',$this->id)->min('price');
        return $price;
    }
    public function getPricePromo(){

        $price_promo = Productline::where('product_id',$this->id)->min('promo_price');
        if($price_promo){
            return $price_promo;
        }
        else{
            return null;
        }

    }
}
