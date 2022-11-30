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
}
