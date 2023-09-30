<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Favoriteline;
use App\Models\Productline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //
    public function index(){
        include(app_path() . '\Functions\header.php');
        return view('favorite',compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id'));

    }
    public function store(Request $request) {

        if(Auth::user()){
            $favorite = Favorite::where('user_id',Auth::user()->id)->first();
            if($favorite){
             $product_exist = Favoriteline::where('productline_id',$request->input('id'))->where('favorite_id',$favorite->id)->first();
                if($product_exist){
                    $data = array(
                    'qtes' => 1,
                    );
                    return $data;
                }
                else{
                   $favorite_line = new Favoriteline();
                    $favorite_line->favorite_id = $favorite->id;
                    $favorite_line->productline_id = $request->input('id');
                    $favorite_line->save();
                    $nbr_favorite = Favoriteline::where('favorite_id',$favorite->id)->count();
                    $data = array(
                        'nbr_favorite' => $nbr_favorite,
                        'qtes' => 0,
                    );

                    return $data;
                }
            }
        }

        else{
         $favorite = session()->get('favorite_id');
            if($favorite){
                $product_exist = Favoriteline::where('productline_id',$request->input('id'))->where('favorite_id',$favorite)->first();
                    if($product_exist){
                        $data = array(
                        'qtes' => 1,
                        );
                        return $data;
                    }

                    $favorite_line = new Favoriteline();
                    $favorite_line->favorite_id = $favorite->id;
                    $favorite_line->productline_id = $request->input('id');
                    $favorite_line->save();
                    $nbr_favorite = Favoriteline::where('favorite_id',$favorite->id)->count();
                    $data = array(
                        'nbr_favorite' => $nbr_favorite,
                        'qtes' => 0,
                    );
                    session()->put('favorite_id', $favorite);
                    return $data;
                }

            else{
                $favorite = new Favorite();
                $favorite->save();
                $favorite_line= new Favoriteline();
                $favorite_line->favorite_id = $favorite->id;
                $favorite_line->productline_id = $request->input('id');
                $favorite_line->save();
                $nbr_favorite = Favoriteline::where('favorite_id',$favorite->id)->count();
                $data = array(
                    'nbr_favorite' => $nbr_favorite,
                    'qtes' => 0,
                );
                session()->put('favorite_id', $favorite);
                return $data;

        }
        }
  }
}
