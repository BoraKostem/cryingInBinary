<?php

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


//Route::get('/', [MainController::class, 'index']);
//Route::get('/index', [MainController::class, 'mainMenu']);

//Route::post('/login',[MainController::class, 'login']);
//Route::resource('', 'App\Http\Controllers\MainController');