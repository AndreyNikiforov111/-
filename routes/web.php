<?php

//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('{page}', MainController::class)->where('page', '.*');

//Route::get('newsletter', App\Http\Controllers\Newsletter\StoreController::class);

//Route::get('test', App\Http\Controllers\TestController::class);
Route::get('history', App\Http\Controllers\HistoryController::class);

Auth::routes();