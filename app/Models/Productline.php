<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productline extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function attributeLine(){

        return $this->belongsTo(Attributeline::class,'attributeline_id');
    }

    public function attribute(){

        return $this->belongsTo(Attribute::class,'attribute_id');
    }
}
