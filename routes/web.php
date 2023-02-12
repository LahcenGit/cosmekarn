<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AttributelineController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/success-payment', function () {
    return view('success');
});
Route::get('/about', function () {
    return view('about');
});

Route::get('/success-order', function () {
    $cartitems = null;
    $nbr_cartitem = 0;
    $total = 0;
    return view('success-order',compact('cartitems','nbr_cartitem','total'));

});


Route::resource('/admin/categories',CategoryController::class);
Route::resource('/admin/attributes',AttributeController::class);
Route::resource('/admin/attributelines',AttributelineController::class);
Route::resource('/admin/orders',OrderController::class);
Route::resource('/admin/products',ProductController::class);
Route::resource('/admin/customers',AdminCustomerController::class);
Route::get('order-details/{id}', [OrderController::class, 'orderDetails']);
Route::get('/get-attribute/{id}', [App\Http\Controllers\ProductController::class, 'getAttribute']);
Route::get('/show-modal', [App\Http\Controllers\ProductController::class, 'showModal']);
Route::post('/add-attribute', [App\Http\Controllers\ProductController::class, 'addAttribute']);
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'detailProduct']);
Route::get('/show-modal-detail-product/{id}', [App\Http\Controllers\ProductController::class, 'showModalDetailProduct']);
Route::get('/get-product/{id}', [App\Http\Controllers\ProductController::class, 'getProduct']);
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'index']);
Route::get('/login-register', [App\Http\Controllers\Auth\LoginController::class, 'loginRegister'])->name('login-register');
Route::resource('/carts',CartController::class);
Route::resource('/',HomeController::class);
Route::resource('/admin',AdminController::class)->middleware('can:admin');

//payment
Route::post('/redirection', [App\Http\Controllers\PaymentController::class, 'redirectionPayment']);
Route::post('/webhook', [App\Http\Controllers\PaymentController::class, 'webhook']);

Auth::routes();

//customer
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index']);
Route::get('/customer/order/{id}', [App\Http\Controllers\CustomerController::class, 'orderDetail']);
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about']);
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
