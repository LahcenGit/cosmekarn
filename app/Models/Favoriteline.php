<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoriteline extends Model
{
    use HasFactory;
    public function productline(){
        return $this->belongsTo(Productline::class,'productline_id');
    }

    public function favorite(){
        return $this->belongsTo(Favorite::class,'favorite_id');
    }
}
