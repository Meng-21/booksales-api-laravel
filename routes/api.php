<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api');





Route::apiResource('/books',BookController::class)->only(['index','show']); 
Route::apiResource('/authors',AuthorController::class)->only(['index','show']);
Route::apiResource('/genres',GenreController::class)-> only(['index','show']);




Route::apiResource('/transactions',TransactionController::class)->only(['index','store','show']);






//hanya admin yang dapat mengakses  store dan update serta menghapus dengan mengumpuk middleware
    Route::middleware(['auth:api','role:admin'])->group(function (){
        Route::apiResource('/books',BookController::class)->only(['store','update','destroy']);

        //pakai exept itu ibarat mau semua kecuali (yang ada di dalam kurung array)
        Route::apiResource('/authors',AuthorController::class)->only(['store','update','destroy']);
        
        Route::apiResource('/genres',GenreController::class)->only(['store','update','destroy']);
        Route::apiResource('/transactions',TransactionController::class)->only(['update','destroy']);
    });







