<?php

namespace App\Http\Controllers;

use App\Mail\MailContact;
use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function index(){
        include(app_path() . '\Functions\header.php');
        return view('contact',compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id'));

    }
    public function store(Request $request){
        Mail::to('benosmanhind@gmail.com')->send(new MailContact($request));
           return 1;
       }
}
