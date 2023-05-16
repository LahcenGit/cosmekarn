<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocart extends Model
{
    use HasFactory;

    protected $fillable = [
         'type',
         'format',
         'date_debut',
         'date_fin',
         'value',
         'product'
        ];

    public function product(){
        $product = Product::where($this ,'id')->first();
        return $product->designation;
    }
}
