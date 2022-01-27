<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Taskapi;
use App\Http\Controllers\API\Authcontroller;

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

// Route::get('/add',[Taskapi::class,'add']);
// Route::post('/addtask',[Taskapi::class,'addtask']);
Route::apiResource('add',Taskapi::class);

Route::post('register',[Authcontroller::class,'register']);
Route::post('login',[Authcontroller::class,'login']);