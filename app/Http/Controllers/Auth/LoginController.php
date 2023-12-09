<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
            if (session('visited_carts_page')){
                return '/carts';
            }
            else{
                return '/';
            }
        }
        else if(Auth::user()->type == 'admin'){
            return '/admin';
        }
     }

     public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => ['required'],
        ],
        [
            'email.required' => 'Ce champ est obligatoire',
            'password.required' => 'Ce champ est obligatoire',
        ]
    );
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $remember_me  = ( !empty( $request->remember_me ) )? TRUE : FALSE;

        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']),$remember_me))
        {
            if(auth::user()->type == 'admin'){
                return redirect('admin');
            }
            else {
                    return redirect('/');
                }
        }
        else{
            $error = 'Coordonnées incorrectes. Veuillez réessayer.';
            include(app_path() . '\Functions\header.php');
            $visited_carts_page = session('visited_carts_page');
            return view('login-register',compact('cart_id','cartitems','nbr_cartitem','total','categories','favoritelines','nbr_favoritelines','error','visited_carts_page'));
            }
}
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function loginRegister(){

        include(app_path() . '\Functions\header.php');
        $visited_carts_page = session('visited_carts_page');
        $error = null;
        return view('login-register',compact('cart_id','cartitems','nbr_cartitem','total','categories','favoritelines','nbr_favoritelines','visited_carts_page','error'));

    }
}
