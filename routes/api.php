<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Productscontroller;

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
Route::get('/data' ,[Productscontroller::class,"getdata"]);
Route::get('/data/{id?}' ,[Productscontroller::class,"dataid"]);
Route::post('/add' ,[Productscontroller::class,"addData"]);
Route::put('/edit' ,[Productscontroller::class,"editData"]);
Route::get('/search/{data}' ,[Productscontroller::class,"search"]);
Route::delete('/delete' ,[Productscontroller::class,"delete"]);

//Route::post("login" ,[UsersController::class,"index"]);
Route::post('/login' ,[UsersController::class,"index"]);