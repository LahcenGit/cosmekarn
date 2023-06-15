<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index(){
        $date = Carbon::now()->format('Y-m-d');
        return view('admin.generate-report',compact('date'));
    }
    public function generateReport(Request $request){
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('Y-m-d');
        if($request->type == 'M'){
            $report = Order::join('orderlines', 'orders.id', '=', 'orderlines.order_id')
                            ->join('productlines', 'orderlines.productline_id', '=', 'productlines.id')
                            ->join('products', 'productlines.product_id', '=', 'products.id')
                            ->join('attributelines', 'productlines.attributeline_id', '=', 'attributelines.id')
                            ->select('orderlines.productline_id', 'products.designation', 'attributelines.value',DB::raw('SUM(orderlines.qte) as total_qte'))
                            ->where('orders.status', 2)
                            ->whereMonth('orders.created_at', $month)
                            ->groupBy('orderlines.productline_id', 'products.designation' ,'attributelines.value')
                            ->get();
        }

        if($request->type == 'A'){
            $report = Order::join('orderlines', 'orders.id', '=', 'orderlines.order_id')
                            ->join('productlines', 'orderlines.productline_id', '=', 'productlines.id')
                            ->join('products', 'productlines.product_id', '=', 'products.id')
                            ->join('attributelines', 'productlines.attributeline_id', '=', 'attributelines.id')
                            ->select('orderlines.productline_id', 'products.designation', 'attributelines.value',DB::raw('SUM(orderlines.qte) as total_qte'))
                            ->where('orders.status', 2)
                            ->whereDate('orders.created_at', $day)
                            ->groupBy('orderlines.productline_id', 'products.designation' ,'attributelines.value')
                            ->get();
        }
        if($request->type == 'P'){
            $report = Order::join('orderlines', 'orders.id', '=', 'orderlines.order_id')
                            ->join('productlines', 'orderlines.productline_id', '=', 'productlines.id')
                            ->join('products', 'productlines.product_id', '=', 'products.id')
                            ->join('attributelines', 'productlines.attributeline_id', '=', 'attributelines.id')
                            ->select('orderlines.productline_id', 'products.designation', 'attributelines.value',DB::raw('SUM(orderlines.qte) as total_qte'))
                            ->where('orders.status', 2)
                            ->whereDate('orders.created_at','>=',$request->datedebut)
                            ->whereDate('orders.created_at','<=',$request->datefin)
                            ->groupBy('orderlines.productline_id', 'products.designation' ,'attributelines.value')
                            ->get();

        }
        return view('admin.report',compact('report'));
        }
}
