<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Cart;
use App\Models\Favorite;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    public function redirectTo(){

        if (session('visited_carts_page')){
            return '/carts';
        }
        else{
            return '/';
        }

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required|unique:users'

        ],
        [
            'password.min' => '8 caractères',
            'email.unique' => 'Ce email existe déja',
            'email.email' => 'e-mail doit être une adresse e-mail valide.',
            'phone.unique' => 'Ce numéro existe déja',
            'phone.required' =>'Ce champ est obligatoire',
            'password.required'=>'le mot de passe est obligatoire',
            'name.required' => 'Ce champ est obligatoire',
            'email.required' => 'Ce champ est obligatoire',
            'phone.required' => 'Ce champ est obligatoire',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'type' => 'customer',
        ]);

        $cart_id = session('cart_id');

        if($cart_id){
            $cart = Cart::find($cart_id);
            $cart->user_id = $user->id;
            $cart->save();
        }
        else{
            $cart = new Cart();
            $user->cart()->save($cart);
        }
        $favorite = new Favorite();
        $favorite->user_id = $user->id;
        $favorite->save();
        Mail::to($user->email)->send(new RegisterMail());
        return $user;

    }
}
