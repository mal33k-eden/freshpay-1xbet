<?php

use App\Http\Controllers\AuxUtilityAuth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/reg',[AuxUtility::class,'register']);
//Route::get('/auth',[AuxUtility::class,'auth']);
//Route::get('/passreset',[AuxUtility::class,'passreset']);
//Route::get('/balance',[AuxUtility::class,'balance']);
//Route::get('/callback',[AuxUtility::class,'callback']);
//Route::get('/auth',[AuxUtility::class,'auth']);
