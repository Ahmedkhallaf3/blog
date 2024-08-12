<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('redirect',[HomeController::class, 'redirect'])->middleware('auth', 'verified');
Route::get('/view_category',[adminController::class, 'view_category']);
Route::post('/add_category',[adminController::class, 'add_category']);
Route::get('/delete_category/{id}',[adminController::class, 'delete_category']);

Route::get('/view_product',[adminController::class, 'view_product']);
Route::post('/add_product',[adminController::class, 'add_product']);
Route::get('/show_product',[adminController::class, 'show_product'])->name('show_product');
Route::get('/delete_product/{id}',[adminController::class, 'delete_product']);
Route::get('/update_product/{id}',[adminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}',[adminController::class, 'update_product_confirm']);
Route::get('/order',[adminController::class, 'order']);
Route::get('/delivered/{id}',[adminController::class, 'delivered']);
Route::get('/print_pdf/{id}',[adminController::class, 'print_pdf']);
Route::get('/send_email/{id}',[adminController::class, 'send_email']);
Route::get('/send_user_email/{id}',[adminController::class, 'send_user_email']);
Route::get('/search',[adminController::class, 'search']);




Route::get('/product_details/{id}',[HomeController::class, 'product_details']);
Route::post('/add_cart/{id}',[HomeController::class, 'add_cart']);
Route::get('show_cart',[HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}',[HomeController::class, 'remove_cart']);
Route::get('cash_order',[HomeController::class, 'cash_order']);
Route::get('/stripe/{totalprice}',[HomeController::class, 'stripe']);
Route::post('/stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');

Route::get('show_order',[HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}',[HomeController::class, 'cancel_order']);





