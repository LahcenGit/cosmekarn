<?php

namespace App\Http\Controllers;

use App\Models\Deliverycost;
use Illuminate\Http\Request;

class DeliverycostController extends Controller
{
    //
    public function index(){
        $delivery_costs = Deliverycost::all();
        return view('admin.delivery-costs',compact('delivery_costs'));
    }

    public function updateDeliveryCost($id , $price_b , $price_a){
        $delivery_cost = Deliverycost::
    }
}
