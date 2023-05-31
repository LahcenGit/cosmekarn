<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Promocart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TheHocineSaad\LaravelAlgereography\Models\Wilaya;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(Request $request){

        $cart = Cart::find($request->cart_id);
        $cartitems = Cartitem::where('cart_id',$request->cart_id)->get();
        $nbr_cartitem = $cartitems->count();
        $total = Cartitem::selectRaw('sum(total) as sum')->where('cart_id',$request->cart_id)->first();
        $categories = Category::where('parent_id',null)->orderby('designation', 'asc')->get();
        $wilayas = Wilaya::all();

        //promo panier 
        $currentDate = Carbon::now()->format('Y-m-d');

        $cart_promo = Promocart::whereDate('date_debut', '<=', $currentDate)
                    ->whereDate('date_fin', '>=', $currentDate)
                    ->where('mt_panier', '<=', $total)
                    ->orderByDesc('mt_panier')
                    ->first();
        if($cart_promo){
           $type_promo = $cart_promo->format ;
           $value_promo = $cart_promo->value ;

           if($cart_promo->type == '0'){//implicite
                if($type_promo  =='0'){ //fix
                    $total_promo = $total - $value_promo ;
                }
                else{//pourcentage
                    $total_promo = $total - ($total*$value_promo)/100 ;
                }
           }
        }
        else{
            $type_promo = null;
            $total_promo = null;
            $value_promo = null;
        }


        return view('checkout',compact('cartitems','nbr_cartitem','total','wilayas','categories','type_promo','total_promo','value_promo'));

    }
}
