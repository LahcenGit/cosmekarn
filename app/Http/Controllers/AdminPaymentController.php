<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TheHocineSaad\LaravelChargilyEPay\Models\Epay_Invoice;

class AdminPaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $payments = Epay_Invoice::orderBy('created_at','desc')->get();
        return view('admin.payments',compact('payments'));
    }
}
