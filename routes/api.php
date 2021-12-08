<?php

use App\Http\Controllers\AuxUtilityAuth;
use App\Http\Controllers\BetController;
use App\Http\Controllers\WalletController;
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

Route::post('/reg',[AuxUtilityAuth::class,'register']);
Route::post('/auth',[AuxUtilityAuth::class,'auth']);
Route::get('/passreset',[AuxUtilityAuth::class,'passreset']);
Route::post('/balance',[AuxUtilityAuth::class,'balance']);
Route::get('/callback',[AuxUtilityAuth::class,'callback']);


Route::post('/get-sports',[BetController::class,'getSports']);
Route::post('/get-games',[BetController::class,'getGames']);
Route::post('/place-bet',[BetController::class,'placeBet']);


Route::post('/deposit',[WalletController::class,'deposit']);
Route::post('/withdraw',[WalletController::class,'withdraw']);
