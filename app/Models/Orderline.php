<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    use HasFactory;


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function productline()
    {
        return $this->belongsTo(Productline::class);
    }

}
