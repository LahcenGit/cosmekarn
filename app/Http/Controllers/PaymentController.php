<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TheHocineSaad\LaravelChargilyEPay\Models\Epay_Invoice;
use TheHocineSaad\LaravelChargilyEPay\Epay_Webhook;

class PaymentController extends Controller
{
    public function redirectionPayment(Request $request){


    $cart = Cart::where('user_id',Auth::user()->id)->first();
    $total = Cartitem::where('cart_id',$cart->id)->sum('total');


    $name = $request->first_name.' '.$request->last_name;

    $order = new Order();
    $order->user_id = Auth::user()->id;
    $order->name = $name;
    $order->status = 0 ;
    $order->wilaya = $request->country;
    $order->address = $request->address;
    $order->phone = $request->phone;
    $order->note = $request->ordernote;
    $order->payment_method = $request->paymentmethod;
    $order->total = $total;

    if($request->coupon){
        $amount = 100;
    }
    else{
        if($request->shipping == '400'){
            $amount = $total + 400;
        }
        else{
            $amount = $total + 700;
        }

    }
    if($request->paymentmethod == 'EDAHABIA' || $request->paymentmethod == 'CIB'){

        $configurations = [
            'user_id' => Auth::user()->id, // (optional) This is the user ID to be added as a foreign key, it's optional, if it's not provided its value will be NULL
            'mode' => 'EDAHABIA', // Payment method must be 'CIB' or 'EDAHABIA'
            'payment' => [
             'client_name' => $name , // Client name
             'client_email' => $request->email, // This is where client receives payment receipt after confirmation
                'amount' => $amount, // Must be = or > than 75
                'discount' => 0, // This is discount percentage, between 0 and 99
                'description' => 'payment for product', // This is the payment description
            ]
        ];


        $checkout_url = Epay_Invoice::make($configurations);
        $invoice = Epay_Invoice::where('user_id',Auth::user()->id)->latest()->first();
        $order->epay_invoice_id = $invoice->id;
        $order->save();
    }

    else{
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
        return redirect('/success-order');
    }

   }

    public function webhook(){
        $webhookHandler = new Epay_Webhook;
        $invoice = Epay_Invoice::where('user_id',Auth::user()->id)->latest()->first();
        $order = Order::where('user_id',Auth::user()->id)->latest()->first();
        if($webhookHandler -> invoiceIsPaied) {
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
