<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
{
        $searchTerm = $request->input('search');// Récupère le terme de recherche depuis le formulaire
        $products = Product::where('designation', 'LIKE', '%' . $searchTerm . '%')->paginate(16);
        $count_products = $products->count();
        include(app_path() . '\Functions\header.php');
        return view('product-search', compact('favoritelines','nbr_favoritelines','categories','cartitems','nbr_cartitem','total','cart_id','products','count_products'));
}
}
