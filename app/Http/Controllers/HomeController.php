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
use App\Models\Slider;

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
        $sliders = Slider::orderBy('flag','asc')->get();
        include(app_path() . '\Functions\header.php');
        return view('welcome',compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id','products','promopacks','random_popular_products','random_best_selling_products','random_products_on_sale','sliders'));

    }
    public function about(){
        include(app_path() . '\Functions\header.php');
        return view('about',compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id'));

    }

    public function categoryProducts($id){
        $category = Category::with('childCategories')->find($id);
        $products = $category->products()->paginate(16);
        $count_products = $products->total();
        include(app_path() . '\Functions\header.php');
        return view('category-products', compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id','category','products','count_products'));
    }

    public function allProductCategory($categorieId)
    {
        $category = Category::with('childCategories', 'products')->find($categorieId);

        $categoryIds = $category->childCategories->pluck('id')->prepend($category->id);

        $products = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })->paginate(16);
        $count_products = $products->total();
        include(app_path() . '\Functions\header.php');
        return view('category-products', compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id','category','products','count_products'));
    }
}
