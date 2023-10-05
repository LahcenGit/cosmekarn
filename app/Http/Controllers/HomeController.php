<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cartitem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productcategory;
use App\Models\Promopack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TheHocineSaad\LaravelChargilyEPay\Models\Epay_Invoice;
use App\Http\Controllers\GetCartAndFavoriteDataController;
class HomeController extends Controller
{
    //

    public function index(){

        $products = Product::whereNotIn('id', function ($query) {
                             $query->select('product_id')->from('promopacks');
        })->get();
        $random_popular_products = Product::whereNotIn('id', function ($query) {
                                    $query->select('product_id')->from('promopacks');
         })->inRandomOrder()->take(4)->get();

         $random_best_selling_products = Product::whereNotIn('id', function ($query) {
            $query->select('product_id')->from('promopacks');
        })->inRandomOrder()->take(4)->get();

        $random_products_on_sale = Product::whereNotIn('id', function ($query) {
            $query->select('product_id')->from('promopacks');
        })->inRandomOrder()->take(4)->get();

        $promopacks = Promopack::orderBy('created_at','desc')->get();
        include(app_path() . '\Functions\header.php');
        return view('welcome',compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id','products','promopacks','random_popular_products','random_best_selling_products','random_products_on_sale'));

    }
    public function about(){
        include(app_path() . '\Functions\header.php');
        return view('about',compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id'));

    }

    public function categoryProducts($id){
        $category = Category::find($id);
        $products = Productcategory::where('category_id',$id)->paginate(16);
        $count_products = Productcategory::where('category_id',$id)->count();
        include(app_path() . '\Functions\header.php');
        return view('category-products', compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id','category','products','count_products'));
    }

}
