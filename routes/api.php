<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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




Route::group(['middleware' => 'auth:api', 'namespace' => 'API', 'prefix' => 'user'], function(){
    Route::post('profile/update', 'AuthController@UserProfileUpdate');
});

Route::post("register",[AuthController::class,"UserRegister"])->name("register");
Route::get("get_data",[AuthController::class,"getData"])->name("gt_data");
Route::post("delete",[AuthController::class,"delete"])->name("delete");
Route::post("update",[AuthController::class,"update"])->name("update");

