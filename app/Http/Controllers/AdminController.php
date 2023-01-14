<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderline;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        $nbr_customers = User::where('type','customer')->count();
        $nbr_orders = Order::count();
        $revenu = Orderline::selectRaw('sum(total) as s')->first();
        $users = User::where('type','customer')->limit('5')->get()->reverse();
        $orders = Order::limit('5')->get()->reverse();
        $order_waiting = Order::where('status',0)->count();
        $order_in_delivering = Order::where('status',1)->count();
        $order_delivered = Order::where('status',2)->count();
        $order_canceled = Order::where('status',3)->count();
        $order_waiting_payment = Order::where('status',4)->count();
        $top_customers = Order::selectRaw('count(*) as s')
                                ->selectRaw('user_id')
                                ->with('user')
                                ->where('status',2)
                                ->groupBy('user_id')
                                ->orderBy('s','desc')->limit('3')->get();


        return view('admin.dashboard-admin',compact('nbr_customers','nbr_orders','revenu','users','orders','order_waiting','order_in_delivering',
                                            'order_delivered','order_canceled','order_waiting_payment','top_customers'));
    }
}
