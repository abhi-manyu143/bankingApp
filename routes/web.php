<?php

use App\Http\Controllers\BankingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/deposit',[BankingController::class, 'creditAmount']);
Route::post('add_amount',[BankingController::class, 'add_amount']);
Route::get('/withdraw',[BankingController::class, 'withdrawView']);
Route::post('withdraw_amount', [BankingController::class, 'withdraw_amount']);
Route::get('/transfer', [BankingController::class, 'Transfer_view']);
Route::post('transfer_amount',[BankingController::class, 'Transfer_Money']);
Route::get('/statement', [BankingController::class, 'view_statement']);
