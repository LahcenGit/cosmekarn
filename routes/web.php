<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AttributelineController;
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


Route::get('/admin', function () {
    return view('admin.dashboard-admin');
});

Route::get('/success-payment', function () {
    return view('success');
});

Route::resource('/admin/categories',CategoryController::class);
Route::resource('/admin/attributes',AttributeController::class);
Route::resource('/admin/attributelines',AttributelineController::class);
Route::resource('/admin/products',ProductController::class);
Route::get('/get-attribute/{id}', [App\Http\Controllers\ProductController::class, 'getAttribute']);
Route::get('/show-modal', [App\Http\Controllers\ProductController::class, 'showModal']);
Route::post('/add-attribute', [App\Http\Controllers\ProductController::class, 'addAttribute']);
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'detailProduct']);
Route::get('/show-modal-detail-product/{id}', [App\Http\Controllers\ProductController::class, 'showModalDetailProduct']);
Route::get('/get-product/{id}', [App\Http\Controllers\ProductController::class, 'getProduct']);
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'index']);
Route::resource('/carts',CartController::class);
Route::resource('/',HomeController::class);

//payment
Route::post('/redirection', [App\Http\Controllers\PaymentController::class, 'redirectionPayment']);
Route::post('/webhook', [App\Http\Controllers\PaymentController::class, 'webhook']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
