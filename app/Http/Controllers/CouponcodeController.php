<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Couponcode;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponcodeController extends Controller
{
    //
    public function index(){
        $coupons = Couponcode::orderBy('created_at','desc')->get();
        return view('admin.coupons',compact('coupons'));
    }
    public function create(){
        $products = Product::orderBy('created_at','desc')->get();
        $categories = Category::where('parent_id',null)->orderBy('created_at','desc')->get();
        $value = null;
        return view('admin.add-coupon-code',compact('products','categories','value'));
    }

    public function store(Request $request){
        $coupon = new Couponcode();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->free_delivery = $request->free_delivery;
        $coupon->expiration_date = $request->expiration_date;
        $coupon->minimum_spend = $request->minimum_spend;
        $coupon->maximum_spend = $request->maximum_spend;
        $coupon->exclude_promo_product = $request->exclude_promo_product;
        $coupon->free_delivery = $request->free_delivery;
        $coupon->individual_use = $request->individual_use;
        $coupon->usage_limit_code = $request->usage_limit_code;
        if($request->products){
            $coupon->products = json_encode($request['products']);
        }
        if($request->exclude_products){
            $coupon->exclude_products = json_encode($request['exclude_products']);
        }
        if($request->categories){
            $coupon->categories = json_encode($request['categories']);
        }
        if($request->exclude_categories){
            $coupon->exclude_categories = json_encode($request['exclude_categories']);
        }
        $coupon->save();
        return redirect('admin/coupons');
    }
}
