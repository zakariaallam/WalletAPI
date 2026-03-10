<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::post('wallet',[WalletController::class,'createWallet'])->middleware('auth:sanctum');;
Route::get('wallet',[WalletController::class,'index'])->middleware('auth:sanctum');;
Route::get('wallet/{id}',[WalletController::class,'detailWallet'])->middleware('auth:sanctum');;

Route::post('wallet/{id}/deposit',[TransactionController::class,'deposit'])->middleware('auth:sanctum');;
Route::post('wallet/{id}/withdraw',[TransactionController::class,'withdraw'])->middleware('auth:sanctum');;
Route::post('wallet/{id}/transfer',[TransactionController::class,'transfer'])->middleware('auth:sanctum');;
Route::post('wallet/{id}/transactions',[TransactionController::class,'transactions'])->middleware('auth:sanctum');;