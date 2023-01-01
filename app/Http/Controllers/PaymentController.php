<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use TheHocineSaad\LaravelChargilyEPay\Models\Epay_Invoice;
use TheHocineSaad\LaravelChargilyEPay\Epay_Webhook;

class PaymentController extends Controller
{
    public function redirectionPayment(Request $request){
    $name = $request->first_name.' '.$request->last_name;

    $configurations = [
        'user_id' => 1, // (optional) This is the user ID to be added as a foreign key, it's optional, if it's not provided its value will be NULL
        'mode' => $request->paymentmethod, // Payment method must be 'CIB' or 'EDAHABIA'
        'payment' => [
         'client_name' => $name , // Client name
         'client_email' => $request->email, // This is where client receives payment receipt after confirmation
            'amount' => 100, // Must be = or > than 75
            'discount' => 0, // This is discount percentage, between 0 and 99
            'description' => 'payment for product', // This is the payment description
        ]
    ];


    $checkout_url = Epay_Invoice::make($configurations);

    return redirect($checkout_url );



    }

    public function webhook(){


        $webhookHandler = new Epay_Webhook;

            $user = User::find(1);
            $user->name = 'lahcene';
            $user->save();



    }
}
