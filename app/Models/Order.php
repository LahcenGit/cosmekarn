<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheHocineSaad\LaravelChargilyEPay\Models\Epay_Invoice;

class Order extends Model
{
    use HasFactory;

    public function orderlines(){
        return $this->hasMany(Orderline::class);
    }

    public function epayInvoice(){
        return $this->belongsTo(Epay_Invoice::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
