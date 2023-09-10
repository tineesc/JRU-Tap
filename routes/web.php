<?php

use App\Livewire\Credits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/credits', Credits::class)->name('credits');
});

Route::controller(PaymentController::class)
->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('process','process')->name('process');
    Route::get('pay','pay')->name('pay');
    Route::get('success','success');
    Route::get('link-pay','linkPay')->name('linkPay');
    Route::get('link-status/{linkid}','linkStatus');
    Route::get('refund','refund');
    Route::get('refund-status/{id}','refundStatus');
 });