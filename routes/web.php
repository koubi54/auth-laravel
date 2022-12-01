<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DiscoreController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\PaymentController;
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


// Route::controller(PayPalPaymentController::class)->group(function(){
//     Route::get('handle-payment', 'handlePayment')->name('make.payment');
//     Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
//     Route::get('payment-success', 'paymentSuccess')->name('success.payment');
// });

Route::controller(PaymentController::class)->group(function(){
    Route::get('handle-payment', 'charge')->name('make.payment');
    Route::get('cancel-payment', 'errorPYP')->name('error.payment');
    Route::get('payment-success', 'success')->name('success.payment');
});

Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToFacebook')->name('auth.google');
    Route::get('auth/google/callback', 'handleFacebookCallback');
});
Route::controller(DiscoreController::class)->group(function(){
    Route::get('auth/discore', 'redirectToFacebook')->name('auth.discore');
    Route::get('auth/discore/callback', 'handleFacebookCallback');
});