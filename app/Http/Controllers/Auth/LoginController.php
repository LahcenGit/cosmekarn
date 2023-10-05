<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function redirectTo(){
        if(Auth::user()->type == 'customer'){
            return '/';
        }
        else if(Auth::user()->type == 'admin'){
            return 'admin/';
        }
     }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginRegister(){

        include(app_path() . '\Functions\header.php');
        return view('login-register',compact('cart_id','cartitems','nbr_cartitem','total','categories','favoritelines','nbr_favoritelines'));

    }
}
