<?php

use App\Http\Controllers\Api\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Userapi
Route::get('/userapi',[RouteController::class,'userlists']);

// Productapi
Route::get('/productapi',[RouteController::class,'productlists']);

// Categoryapi
Route::get('/categoryapi',[RouteController::class,'categorylists']);

// Productapi create
Route::post('/productapi/create',[RouteController::class,'productcreate']);

// Categoryapi create
Route::post('/category/create',[RouteController::class,'categorycreate']);

// Category api delete
Route::post('/category/delete',[RouteController::class,'categorydelete']);

// Category api update
Route::post('/category/update',[RouteController::class,'categoryupdate']);












/**
 * //UserApi
 * http://127.0.0.1:8000/api/userapi
 *
 * //ProductApi
 * http://127.0.0.1:8000/api/productapi
 *
 *  //CategoryApi
 * http://127.0.0.1:8000/api/categoryapi
 *
 *  //CategoryCreateApi
 * http://127.0.0.1:8000/api/category/create
 *
 * //Category Delete Api
 * http://127.0.0.1:8000/api/category/delete
 *
 * //Category Update Api
 * http://127.0.0.1:8000/api/category/update
 *
 *
 *
 */
