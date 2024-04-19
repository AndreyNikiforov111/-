<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Clients\CreateController;

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


Route::get('/client/create',    App\Http\Controllers\Clients\CreateController::class);
Route::post('/client',          App\Http\Controllers\Clients\StoreController::class);
Route::get('/client',           App\Http\Controllers\Clients\IndexController::class);
Route::post('/client/import',   App\Http\Controllers\Clients\ImportController::class);
Route::get('/newsletter',       App\Http\Controllers\Newsletter\CreateController::class);
Route::post('/newsletter',      App\Http\Controllers\Newsletter\StoreController::class);
Route::match(['get', 'post'], '/history',          App\Http\Controllers\HistoryController::class);