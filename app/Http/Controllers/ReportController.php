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
        return view('admin.generate-report');
    }
    public function generateReport(Request $request){
        $month = Carbon::now()->format('m');

        $report = Order::join('orderlines', 'orders.id', '=', 'orderlines.order_id')
        ->join('productlines', 'orderlines.productline_id', '=', 'productlines.id')
        ->join('products', 'productlines.product_id', '=', 'products.id')
        ->join('attributelines', 'productlines.attributeline_id', '=', 'attributelines.id')
        ->select('orderlines.productline_id', 'products.designation', 'attributelines.value',DB::raw('SUM(orderlines.qte) as total_qte'))
        ->where('orders.status', 2)
        ->whereMonth('orders.created_at', $month)
        ->groupBy('orderlines.productline_id', 'products.designation' ,'attributelines.value')
        ->get();
        return view('admin.report',compact('report'));
        }
}
