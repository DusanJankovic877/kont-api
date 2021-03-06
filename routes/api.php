<?php
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($router){
    Route::post('/logout', [AuthController::class , 'logout']);
    Route::post('/login', [AuthController::class , 'login']);
    Route::get('/me', [AuthController::class , 'me']);
    Route::post('/create', [ PostController::class, 'store']);
    Route::get('/posts', [ PostController::class, 'index']);
    Route::get('/posts/{id}', [ PostController::class, 'show']);
    Route::delete('/posts/{id}', [ PostController::class, 'destroy']);

});
    // Route::middleware('auth')->get('/me', function(){
    //     return auth()->user();
    // });
Route::post('/mail', [ MailController::class, 'store' ]);



