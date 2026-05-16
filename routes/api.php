<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// //router user login
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// //public semua bisa akses
// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);

// //user sudah melakukan login
// Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api');




// //public
// Route::apiResource('/books',BookController::class)->only(['index','show']);
// Route::apiResource('/authors',AuthorController::class)->only(['index','show']);
// Route::apiResource('/genres',GenreController::class)-> only(['index','show']);




// Route::apiResource('/transactions',TransactionController::class)->only(['index','store','show']);






// //hanya admin yang dapat mengakses  store dan update serta menghapus dengan mengumpuk middleware
//     Route::middleware(['auth:api','role:admin'])->group(function (){

//         //pakai exept itu ibarat mau semua kecuali (yang ada di dalam kurung array)

//         Route::apiResource('/transactions',TransactionController::class)->only(['update','destroy']);
//     });


// Route::apiResource('/books',BookController::class)->only(['store','update','destroy']);
// Route::apiResource('/authors',AuthorController::class)->only(['store','update','destroy']);
// Route::apiResource('/genres',GenreController::class)->only(['store','update','destroy']);




// PUBLIC
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::get(
'/books/best-seller',
[BookController::class,'bestSeller']
);
Route::apiResource('/books',BookController::class)
    ->only(['index','show']);

Route::apiResource('/authors',AuthorController::class)
    ->only(['index','show']);

Route::apiResource('/genres',GenreController::class)
    ->only(['index','show']);


// CUSTOMER
Route::middleware('jwt.auth')->group(function (){

    Route::post('/logout',[AuthController::class,'logout']);

    Route::get(
        '/transactions/history',
        [TransactionController::class,'history']
    );

    Route::apiResource('/transactions',TransactionController::class)
        ->only(['index','store','show']);
});


// ADMIN
Route::middleware(['auth:api','role:admin'])->group(function (){



    Route::apiResource('/books',BookController::class)
        ->only(['store','update','destroy']);

    Route::apiResource('/authors',AuthorController::class)
        ->only(['store','update','destroy']);

    Route::apiResource('/genres',GenreController::class)
        ->only(['store','update','destroy']);


    Route::apiResource('/transactions',TransactionController::class)
        ->only(['update','destroy']);

    Route::apiResource('/users', UserController::class)
        ->only(['index']);
});

