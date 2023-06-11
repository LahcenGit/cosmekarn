<?php

namespace App\Http\Controllers;

use App\CalculateTotal;
use App\Models\Center;
use App\Models\Deliverycost;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Models\Productline;
use App\Models\Promocart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CalculateTotalController;
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
        $resultatsCalcul = (new CalculateTotalController)->calculerTotal($request->products ,$request->wilaya ,$request->commune , $request->shipping , $request->qte);
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->wilaya = $request->wilaya;
        $order->commune = $request->commune;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->total = $resultatsCalcul['total'];
        $order->total_f =  $resultatsCalcul['total_f'];
        $order->delivery_cost = $resultatsCalcul['delivery_cost'];
        $order->value = $resultatsCalcul['value'];
        $order->save();

        for($i=0 ; $i<count($request->products) ;$i++){
            $orderline = new Orderline();
            $orderline->order_id = $order->id;
            $orderline->productline_id = $request->products[$i];
            $orderline->qte = $request->qte[$i];
            $productline = Productline::where('id',$request->products[$i])->first();
            if($productline->promo_price){
                $orderline->price = $productline->promo_price;
                $orderline->total = $productline->promo_price * $request->qte[$i];
            }
            else{
                $orderline->price = $productline->price;
                $orderline->total = $productline->price * $request->qte[$i];
            }

               $orderline->save();
        }
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

     public function addOrderStepOne(){
        $productlines = Productline::orderBy('created_at','desc')->get();
        $customers = User::where('type','customer')->get();
        $wilayas = Deliverycost::select('*')->groupBy('wilaya')->get();
        return view('admin.add-order-step-one',compact('productlines','customers','wilayas'));
     }

     public function addOrderSteptwo(Request $request){

        $ids = $request->product;
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $address = $request->input('address');
        $wilaya = $request->input('wilaya');
        $commune = $request->input('commune');
        $center = $request->input('center');
        $phone = $request->input('phone');
        // Enregistrez les détails du client dans une session
        session()->put('customer', [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'address' => $address,
            'wilaya' => $wilaya,
            'commune' => $commune,
            'center' => $center,
            'phone' => $phone,
        ]);
        $customer = session('customer');

        $products = Productline::whereIn('id', $ids)->get()->sortBy(function ($item) use ($ids) {
            return array_search($item, $ids);
        });
        $ids = $products->pluck('id');
        $qte = $request->qte;
        $shipping = $request->shipping;
        $resultatsCalcul = (new CalculateTotalController)->calculerTotal($ids , $wilaya , $commune , $shipping , $qte);
        $total_promo = $resultatsCalcul['total'];
        $total = $resultatsCalcul['total'];
        $total_f = $resultatsCalcul['total_f'];
        $delivery_cost = $resultatsCalcul['delivery_cost'];
        $value_promo = $resultatsCalcul['value'];
        return view('admin.add-order-step-two',compact('products','qte','total_promo','total','total_f','delivery_cost','value_promo','customer','shipping'));
     }

     public function storeOrder(Request $request){
        $products = $request->product;
        $qte = $request->qte;
        $wilaya = $request->wilaya;
        $commune = $request->commune;
        $shipping = $request->shipping;
        $resultatsCalcul = (new CalculateTotalController)->calculerTotal($products , $wilaya , $commune , $shipping , $qte);

        //store order
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->status = 0 ;
        $order->wilaya = $wilaya;
        $order->commune = $commune;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->payment_method = 'cash';
        $order->total = $resultatsCalcul['total'];
        $order->total_f =  $resultatsCalcul['total_f'];
        $order->delivery_cost = $resultatsCalcul['delivery_cost'];
        if($shipping == 'bureau'){
            $order->is_stopdesk = true;
            $order->stopdesk_id = $request->center;
        }
        else{
            $order->is_stopdesk = false;
        }
        $order->value = $resultatsCalcul['value'];
        $date = Carbon::now()->format('y');
        $order->code = 'ck'.'-'.$date.'-'.$order->id;

        $order->save();

        for($i=0 ; $i<count($products) ;$i++){
            $orderline = new Orderline();
            $orderline->order_id = $order->id;
            $orderline->productline_id = $products[$i];
            $orderline->qte = $qte[$i];
            $productline = Productline::where('id',$request->product[$i])->first();
            if($productline->promo_price){
                $orderline->price = $productline->promo_price;
                $orderline->total = $productline->promo_price * $request->qte[$i];
            }
            else{
                $orderline->price = $productline->price;
                $orderline->total = $productline->price * $request->qte[$i];
            }

               $orderline->save();
        }
        return redirect('admin/orders');
     }

}
