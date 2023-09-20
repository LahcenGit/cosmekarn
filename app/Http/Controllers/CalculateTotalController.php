<?php

namespace App\Http\Controllers;

use App\Models\Cartitem;
use App\Models\Couponcode;
use App\Models\Deliverycost;
use App\Models\Product;
use App\Models\Productline;
use App\Models\Promocart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalculateTotalController extends Controller
{
    //
    public function calculerTotal($products , $wilaya , $commune , $shipping , $qte ,$coupon)
    {
        // Effectuez le calcul du total des produits selon la logique souhaitée
        $type_promo = null;
        $total_promo = null;
        $value_promo = null;
        $currentDate = Carbon::now()->format('Y-m-d');
        $total = 0;
        $total_f = 0;
        $delivery_cost = Deliverycost::where('wilaya',$wilaya)->where('commune',$commune)->first();
        $panierProduits = [];

        for($i=0; $i<count($products) ; $i++){
            $productline = Productline::where('id',$products[$i])->first();// calculate total
            array_push($panierProduits , $productline->product_id); //push id product

            if($productline->promo_price != NULL){
                $total = $total + $productline->promo_price * $qte[$i];

            }
            else{
                $total = $total + $productline->price * $qte[$i];
            }
        }


        // test code coupon
        $code = Couponcode::where('code',$coupon)->first();
        if($code){
            $date_expiration = Carbon::parse($code->expiration_date );
        }
        // Récupérez les catégories des produits dans le panier
        $cart_product_categories = Product::join('productcategories', 'products.id', '=', 'productcategories.product_id')
                                        ->whereIn('product_id', $products)
                                        ->distinct()
                                        ->pluck('category_id')
                                        ->toArray();

        $date_now = Carbon::now();
        if($code && $date_expiration->gt($date_now) && $code->usage_limit_code > 0){
            $coupon_categories = json_decode($code->categories);
            // Vérifiez si toutes les catégories des produits dans le panier correspondent aux catégories du coupon
            $all_categories_match = array_diff($cart_product_categories, $coupon_categories);

            if ($code->minimum_spend !== null) {
            if ($total >= $code->minimum_spend) {
                if($code->categories !== null && $all_categories_match){
                    if($code->type =='0'){ //fix
                        $total_promo = $total - $code->value ;

                    }
                    else{//pourcentage

                        $total_promo =  $total - ( $total * $code->value)/100 ;

                    }
                }
                else{
                    if($code->type =='0'){ //fix
                        $total_promo = $total - $code->value ;

                    }
                    else{//pourcentage

                        $total_promo =  $total - ( $total * $code->value)/100 ;

                    }
                }
                }

            }
            else{
                if($code->categories !== null && $all_categories_match){
                    if($code->type =='0'){ //fix
                        $total_promo = $total_promo - $code->value ;

                    }
                    else{//pourcentage

                        $total_promo =  $total - ( $total * $code->value)/100 ;

                    }
                }
                else{
                    if($code->type =='0'){ //fix
                        $total_promo = $total - $code->value ;

                    }
                    else{//pourcentage

                        $total_promo =  $total - ( $total * $code->value)/100 ;

                    }
                }
            }
        }

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

            if (!empty($panierProduits) && $promoProducts->isNotEmpty() && count(array_intersect($panierProduits, $promoProducts->toArray())) === $promoProducts->count()) {

                $has_promo = true ;
                $type_promo = $promo->format ;
                $value_promo = $promo->value ;

                if($type_promo  =='0'){ //fix
                    $total_promo = $total - $value_promo ;

                }
                else{//pourcentage
                    $total_promo = $total - ($total*$value_promo)/100 ;
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
        if($total_promo){
            if($shipping == "bureau"){
               $total_f = $total_promo + $delivery_cost->price_b;
               $delivery_cost = $delivery_cost->price_b;
            }
            if($shipping == "domicile"){
                $total_f = $total_promo + $delivery_cost->price_a + $delivery_cost->supp;
                $delivery_cost = $delivery_cost->price_a + $delivery_cost->supp;
            }
         }
        else{
            if($shipping == "bureau"){
                $total_f = $total + $delivery_cost->price_b;
                $delivery_cost = $delivery_cost->price_b;
            }
             if($shipping == "domicile"){
                 $total_f = $total + $delivery_cost->price_a + $delivery_cost->supp;
                 $delivery_cost = $delivery_cost->price_a + $delivery_cost->supp;
             }
        }

        return [
            'total' => $total,
            'total_f' => $total_f,
            'delivery_cost' => $delivery_cost,
            'value' => $value_promo,
        ];
    }
}
