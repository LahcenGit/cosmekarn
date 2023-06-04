<?php

namespace App\Http\Controllers;

use App\Models\Deliverycost;
use App\Models\Order;
use App\Models\Orderline;
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
        return view('admin.edit-order',compact('order'));
        }

    public function update(Request $request , $id){
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();
        return redirect('admin/orders');
    }

    public function orderDEtails($id){
        $orderlines = Orderline::where('order_id',$id)->get();
        $total = 0;
        foreach($orderlines as $orderline){
            $total = $total + $orderline->total;
        }
        return view('admin.modal-order-details',compact('orderlines','total'));
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
                    "is_stopdesk"=> false,
                    "stopdesk_id" => null,
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
