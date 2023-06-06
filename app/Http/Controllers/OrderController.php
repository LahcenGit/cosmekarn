<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Deliverycost;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Models\Productline;
use App\Models\Promocart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(){
        $orders = Order::all()->reverse();
        return view('admin.orders',compact('orders'));
    }

    public function edit($id){
        $order = Order::find($id);
        $wilayas =Deliverycost::select('*')->groupBy('wilaya')->get();
        $communes = Deliverycost::where('wilaya',$order->wilaya)->pluck('commune');
        $orderlines = Orderline::where('order_id',$id)->get();
        $products = Productline::orderBy('created_at','asc')->with('attributeLine')->get();
        $centers = Center::where('wilaya_name',$order->wilaya)->get();
        return view('admin.edit-order',compact('order','wilayas','communes','orderlines','products','centers'));
        }

    public function update(Request $request , $id){
        $order = Order::find($id);
        $orderlines = Orderline::where('order_id',$id)->get();
        foreach($orderlines as $orderline){
            $orderline->delete();
        }
        $type_promo = null;
        $total_promo = null;
        $value_promo = null;
        $currentDate = Carbon::now()->format('Y-m-d');
        $total = 0;
        $delivery_cost = Deliverycost::where('wilaya',$request->wilaya)->where('commune',$request->commune)->first();
        $panierProduits = [];
       for($i=0; $i<count($request->products) ; $i++){
            $productline = Productline::where('id',$request->products[$i])->first();// calculate total
            array_push($panierProduits , $productline->product_id); //push id product
             // store order line
                $orderline = new Orderline();
                $orderline->order_id = $id;
                $orderline->productline_id = $request->products[$i];
                $orderline->qte = $request->qte[$i];

            if($productline->promo_price){
                $total = $total + $productline->promo_price * $request->qte[$i];
                $orderline->price = $productline->promo_price;
                $orderline->total = $productline->promo_price * $request->qte[$i];
            }
            else{
                $total = $total + $productline->price * $request->qte[$i];
                $orderline->price = $productline->price;
                $orderline->total = $productline->price * $request->qte[$i];
            }

               $orderline->save();
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
        if($total_promo){
            if($request->shipping == "bureau"){
               $total_f = $total_promo + $delivery_cost->price_b;
               $order->delivery_cost =  $delivery_cost->price_b;
               $order->is_stopdesk = true;
               $order->stopdesk_id= $request->center;
            }
            if($request->shipping == "domicile"){
                $total_f = $total_promo + $delivery_cost->price_a + $delivery_cost->supp;
                $order->delivery_cost =  $delivery_cost->price_a + $delivery_cost->supp;
                $order->is_stopdesk = false;
            }
         }
        else{
            if($request->shipping == "bureau"){
                $total_f = $total + $delivery_cost->price_b;
                $order->delivery_cost =  $delivery_cost->price_b;
                $order->is_stopdesk = true;
                $order->stopdesk_id= $request->center;

             }
             if($request->shipping == "domicile"){
                 $total_f = $total + $delivery_cost->price_a + $delivery_cost->supp;
                 $order->delivery_cost =  $delivery_cost->price_a + $delivery_cost->supp;
                 $order->is_stopdesk = false;
                 $order->stopdesk_id = NULL;

             }
        }

        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->wilaya = $request->wilaya;
        $order->commune = $request->commune;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->total = $total;
        $order->total_f = $total_f;
        $order->value = $value_promo;
        $order->save();

        return redirect('admin/orders');
    }



    public function orderDetail($id){
        $order = Order::find($id);
        $orderlines = Orderline::where('order_id',$id)->get();
        return view('admin.detail-order',compact('order','orderlines'));
    }

    public function addOrderToYalidine($id){
        $order = Order::find($id);
        $wilayas = Deliverycost::select('*')->groupBy('wilaya')->get();
        $communes = Deliverycost::where('wilaya',$order->wilaya)->pluck('commune');

        return view('admin.modal-add-order-to-yalidine',compact('order','wilayas','communes'));
    }
    public function getCommunes($name){
        return $communes = Deliverycost::where('wilaya',$name)->pluck('commune');
     }


     public function storeOrderToYalidine($id){
        $order = Order::find($id);

        $url = "https://api.yalidine.app/v1/parcels/";
        $api_id = "73822021614736410875"; // your api ID
        $api_token = "qUYJABlF0Sv4K4jDG2516wSGKEwsVqnCaAQ8l3W8BJbpa9sm9jODZLIxr7cM2Rz5"; // your api token

        $data =
            array( // the array that contains all the parcels
                array ( // first parcel
                    "order_id"=>$id,
                    "from_wilaya_name"=>"Oran",
                    "firstname"=>$order->first_name,
                    "familyname"=>$order->last_name,
                    "contact_phone"=>$order->phone,
                    "address"=>$order->address,
                    "to_commune_name"=>$order->commune,
                    "to_wilaya_name"=>$order->wilaya,
                    "product_list"=>"LICB+ A43G A320",
                    "price"=>$order->total_f,
                    "do_insurance" => false,
                    "declared_value" => 3500,
                    "height"=> 0,
                    "width" => 0,
                    "length" => 0,
                    "weight" => 0,
                    "freeshipping"=> false,
                    "is_stopdesk"=> $order->is_stopdesk,
                    "stopdesk_id" => $order->stopdesk_id,
                    "has_exchange"=> 0,
                    "product_to_collect" => null
                ),

            );

        $postdata = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "X-API-ID: ". $api_id,
                "X-API-TOKEN: ". $api_token,
                "Content-Type: application/json"
            )
        );

        $result = curl_exec($ch);
        curl_close($ch);
        $order->status = 1;
        $response_array = json_decode($result,true);
        $order->tracking_code = $response_array[1]['tracking'];
        $order->save();

        return true;
     }
}
