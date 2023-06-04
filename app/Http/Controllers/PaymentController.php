<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Deliverycost;
use App\Models\Order;
use App\Models\Orderline;
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

    $type_promo = null;
    $total_promo = null;
    $value_promo = null;
    $currentDate = Carbon::now()->format('Y-m-d');
    $panierProduits = Cartitem::join('productlines', 'cartitems.productline_id', '=', 'productlines.id')
                                ->select('productlines.product_id')
                                ->where('cart_id',$request->cart_id)
                                ->pluck('productlines.product_id');

    //promo panier explicite
    $carts_promo_explicite = Promocart::whereDate('date_debut', '<=', $currentDate)
                    ->whereDate('date_fin', '>=', $currentDate)
                    ->where('type',1)
                    ->get();

    if($carts_promo_explicite){
        $promoProducts = collect([]);
        foreach ($carts_promo_explicite as $promo) {
            $promoProducts = $promoProducts->merge(json_decode($promo->product));

        }

        if ($panierProduits->isNotEmpty() && $promoProducts->isNotEmpty() &&$panierProduits->intersect($promoProducts)->count() === $promoProducts->count()) {
            $has_promo = true ;
            $type_promo = $promo->format ;
            $value_promo = $promo->value ;

            if($type_promo  =='0'){ //fix
                $total_promo = $total->sum - $value_promo ;

            }
            else{//pourcentage
                $total_promo = $total->sum - ($total*$value_promo)/100 ;
            }
        }
        else{//promo panier implicite
            $cart_promo_implicite = Promocart::whereDate('date_debut', '<=', $currentDate)
            ->whereDate('date_fin', '>=', $currentDate)
            ->where('mt_panier', '<=', $total)
            ->where('type',0)
            ->orderByDesc('mt_panier')
            ->first();
           if($cart_promo_implicite){
            $has_promo = true ;
            $type_promo = $cart_promo_implicite->format ;
            $value_promo = $cart_promo_implicite->value ;

            if($cart_promo_implicite->type == '0'){//implicite
                if($type_promo  =='0'){ //fix
                    $total_promo = $total - $value_promo ;

                }
                else{//pourcentage
                    $total_promo = $total - ($total*$value_promo)/100 ;
                }
            }
            }

        }
    }
    else{
        $cart_promo_implicite = Promocart::whereDate('date_debut', '<=', $currentDate)
            ->whereDate('date_fin', '>=', $currentDate)
            ->where('mt_panier', '<=', $total->sum)
            ->where('type',0)
            ->orderByDesc('mt_panier')
            ->first();
           if($cart_promo_implicite){
            $has_promo = true ;
            $type_promo = $cart_promo_implicite->format ;
            $value_promo = $cart_promo_implicite->value ;

            if($cart_promo_implicite->type == '0'){//implicite
                if($type_promo  =='0'){ //fix
                    $total_promo = $total->sum - $value_promo ;

                }
                else{//pourcentage
                    $total_promo = $total->sum - ($total*$value_promo)/100 ;
                }
            }
            }

    }

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


    $order->total = $total;

    if($total_promo){
        if($request->shipping){
           $total_f = $total_promo + $request->shipping;
        }
     }
    else{
        $total_f = $total + $request->shipping;
    }
    $order->total_f = $total_f;
    $order->value = $value_promo;
    $order->delivery_cost =  $request->shipping;
    if($request->paymentmethod == 'EDAHABIA' || $request->paymentmethod == 'CIB'){

        $configurations = [
            'user_id' => Auth::user()->id, // (optional) This is the user ID to be added as a foreign key, it's optional, if it's not provided its value will be NULL
            'mode' => 'EDAHABIA', // Payment method must be 'CIB' or 'EDAHABIA'
            'payment' => [
             'client_name' => $name , // Client name
             'client_email' => $request->email, // This is where client receives payment receipt after confirmation
                'amount' => $total_f, // Must be = or > than 75
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
        return redirect('/success-order');
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
