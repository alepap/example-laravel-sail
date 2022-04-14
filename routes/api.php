<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController,BeerController};


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





Route::prefix('v1')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/login', 'login');
        });

        Route::controller(BeerController::class)->group(function () {
            Route::get('/beers', 'indexV1')->middleware('auth:sanctum');
            
        });

});
