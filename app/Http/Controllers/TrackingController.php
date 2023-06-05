<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function tracking(){
        include(app_path() . '\Functions\header.php');
        return view('tracking',compact('cartitems','nbr_cartitem','total','categories'));
    }


    public function trackingResult(Request $request){
        include(app_path() . '\Functions\header.php');


        $url = "https://api.yalidine.app/v1/histories/".$request->codetrack; // the parcel's endpoint
        $api_id = "73822021614736410875"; // your api ID
        $api_token = "qUYJABlF0Sv4K4jDG2516wSGKEwsVqnCaAQ8l3W8BJbpa9sm9jODZLIxr7cM2Rz5"; // your api token
        $code = $request->codetrack;
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-API-ID: '. $api_id,
                'X-API-TOKEN: '. $api_token
            ),
        ));
    
        $response_json = curl_exec($curl);
        curl_close($curl);

    
        $response_array = json_decode($response_json,true);
        $response_array = $response_array['data'];



        return view('tracking-result',compact('cartitems','nbr_cartitem','total','categories','response_array','code'));
    }
    
    public function retrivedata(){

        
        $url = "https://api.yalidine.app/v1/centers/"; // the parcel's endpoint
        $api_id = "73822021614736410875"; // your api ID
        $api_token = "qUYJABlF0Sv4K4jDG2516wSGKEwsVqnCaAQ8l3W8BJbpa9sm9jODZLIxr7cM2Rz5"; // your api token
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-API-ID: '. $api_id,
                'X-API-TOKEN: '. $api_token
            ),
        ));
    
        $response_json = curl_exec($curl);
        curl_close($curl);

        $response_array = json_decode($response_json,true);

        foreach($response_array['data'] as $data){
            $center = New Center();
            $center->center_id = $data['center_id'];
            $center->name =  $data['name'];
            $center->address = $data['address'] ;
            $center->gps =  $data['gps'];
            $center->commune_id =  $data['commune_id'];
            $center->commune_name =  $data['commune_name'];
            $center->wilaya_id =  $data['wilaya_id'];
            $center->wilaya_name = $data['wilaya_name'] ;
            $center->save();
        }



    }


}
