<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Center;
use App\Models\Deliverycost;
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
        $wilayas = Deliverycost::select('*')->groupBy('wilaya')->get();

        //promo panier
        $type_promo = null;
        $total_promo = null;
        $value_promo = null;
        $has_promo = false;
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


         return view('checkout',compact('cartitems','nbr_cartitem','total','wilayas','categories','type_promo','total_promo','value_promo','has_promo'));

    }


    public function getCommunes($name){
       return $communes = Deliverycost::where('wilaya',$name)->get('commune');
    }

    public function getCenters($name){
       return $centers = Center::where('wilaya_name',$name)->get();
    }

    public function getCost($wilaya,$commune){
        return  $cost = Deliverycost::where('wilaya',$wilaya)->where('commune',$commune)->first();
    }
}
