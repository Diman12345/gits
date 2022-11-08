<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function ($router) {

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/register', [AuthController::class, 'register']); 

});

Route::middleware(['jwt.verify'])->group(function() {
    Route::resource('book', BookController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('publisher', PublisherController::class);

    Route::get('/book/author/{id}', [BookController::class, 'index_author']);
    Route::get('/book/publisher/{id}', [BookController::class, 'index_pub']);
});



