<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Couponcode;
use App\Models\Deliverycost;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Models\Promocart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TheHocineSaad\LaravelChargilyEPay\Models\Epay_Invoice;
use TheHocineSaad\LaravelChargilyEPay\Epay_Webhook;

class PaymentController extends Controller
{
    public function redirectionPayment(Request $request){
    $cart = Cart::where('user_id',Auth::user()->id)->first();
    $total = Cartitem::where('cart_id',$cart->id)->sum('total');
    $date = Carbon::now()->format('y');
    $delivery_cost = Deliverycost::where('wilaya',$request->country)->where('commune',$request->commune)->first();
    $type_promo = null;
    $total_promo = null;
    $value_promo = null;
    $currentDate = Carbon::now()->format('Y-m-d');
    $panierProduits = Cartitem::join('productlines', 'cartitems.productline_id', '=', 'productlines.id')
                                ->select('productlines.id')
                                ->where('cart_id',$cart->id)
                                ->pluck('productlines.id');

    $qte = Cartitem::select('qte')
                    ->where('cart_id',$cart->id)
                    ->pluck('qte');
    $resultatsCalcul = (new CalculateTotalController)->calculerTotal($panierProduits ,$request->country ,$request->commune , $request->shipping , $qte ,$request->coupon);
    $name = $request->first_name.' '.$request->last_name;
    $order = new Order();
    $order->user_id = Auth::user()->id;
    $order->first_name = $request->first_name;
    $order->last_name = $request->last_name;
    $order->status = 0 ;
    $order->wilaya = $request->country;
    $order->commune = $request->commune;
    $order->address = $request->address;
    $order->phone = $request->phone;
    $order->note = $request->ordernote;
    $order->payment_method = $request->paymentmethod;
    $order->total = $resultatsCalcul['total'];
    $order->total_f =  $resultatsCalcul['total_f'];
    $order->delivery_cost = $resultatsCalcul['delivery_cost'];
    $order->value = $resultatsCalcul['value'];
     if($request->paymentmethod == 'EDAHABIA' || $request->paymentmethod == 'CIB'){

        $configurations = [
            'user_id' => Auth::user()->id, // (optional) This is the user ID to be added as a foreign key, it's optional, if it's not provided its value will be NULL
            'mode' => 'EDAHABIA', // Payment method must be 'CIB' or 'EDAHABIA'
            'payment' => [
             'client_name' => $name , // Client name
             'client_email' => $request->email, // This is where client receives payment receipt after confirmation
                'amount' =>  $resultatsCalcul['total_f'], // Must be = or > than 75
                'discount' => 0, // This is discount percentage, between 0 and 99
                'description' => 'payment for product', // This is the payment description
            ]
        ];


        $checkout_url = Epay_Invoice::make($configurations);
        $invoice = Epay_Invoice::where('user_id',Auth::user()->id)->latest()->first();
        $order->epay_invoice_id = $invoice->id;
        $order->save();
        $order->code = 'ck'.'-'.$date.'-'.$order->id;
        $order->save();
    }

    else{
        $order->save();
        $order->code = 'ck'.'-'.$date.'-'.$order->id;
        $order->save();
    }

    foreach($cart->cartitems as $item){
        $orderline = new Orderline();
        $orderline->order_id = $order->id;
        $orderline->productline_id = $item->productline_id;
        $orderline->qte = $item->qte;
        $orderline->price = $item->price;
        $orderline->total = $item->total;
        $orderline->save();
        $item->delete();
    }

    if($request->paymentmethod == 'EDAHABIA' || $request->paymentmethod == 'CIB'){
        return redirect($checkout_url);
    }

    else{
        $categories = Category::where('parent_id',null)->orderby('designation', 'asc')->get();
        if(Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            $cartitems = $cart->cartitems;

            if($cartitems ){
                $nbr_cartitem = $cart->cartitems->count();
                $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$cart->id)->first();
            }
            else{
                $cartitems = null;
                $nbr_cartitem = 0;
                $total = 0;
            }

        }
        else{
            $cart= session('cart_id');
            $cartitems = Cartitem::where('cart_id',$cart)->get();
            $nbr_cartitem = Cartitem::where('cart_id',$cart)->count();
            $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$cart)->first();
        }
        return view('success-order',compact('cartitems','nbr_cartitem','total','categories'));
    }

   }

    public function webhook(){

        $webhookHandler = new Epay_Webhook;

        $email = $webhookHandler->invoice['client_email'];
        $invoice = Epay_Invoice::where('client_email', $email)->latest()->first();
        $order = Order::where('user_id',$invoice->user_id)->latest()->first();

        if($webhookHandler->invoiceIsPaied) {
            $invoice->paid = 1;
            $invoice->fee = $webhookHandler->invoice['fee'];
            $invoice->due_amount = $webhookHandler->invoice['due_amount'];
            $invoice->invoice_number = $webhookHandler->invoice['invoice_number'];
            $invoice->save();
            // Put here the logic you want to happen if the user actually made the payment.
        }
        else {
            $order->status = 4;
            $order->save();
            // Put here the logic you want to happen if the user canceled the payment.
        }

    }
}
