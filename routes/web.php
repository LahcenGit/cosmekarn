<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributelineController;


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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('admin.dashboard-admin');
});

Route::resource('/admin/categories',CategoryController::class);
Route::resource('/admin/attributes',AttributeController::class);
Route::resource('/admin/attributelines',AttributelineController::class);
Route::resource('/admin/products',ProductController::class);
Route::get('/get-attribute/{id}', [App\Http\Controllers\ProductController::class, 'getAttribute']);
Route::get('/showModal', [App\Http\Controllers\ProductController::class, 'showModal']);
