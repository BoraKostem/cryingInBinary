<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PdfUpload;
use App\Http\Controllers\UserAuth;
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

//Route::get('/', function () {
//    return view('login');
//});

//General Logout
Route::get('auth/logout',[UserAuth::class,'logout'])->name('auth.logout');

//User Login

Route::post('user',[UserAuth::class,'userLogin']);
Route::post('chngnws',[MainController::class,'changeNews']);


Route::group(['middleware'=>['authCheck']], function(){
    Route::get('login',[UserAuth::class,'login'])->name('auth.login');
    
    Route::get('dashboard',[UserAuth::class,'dashboard']); //Dashboard of the patient
    
    Route::get('upload', [UserAuth::class,'upload']);
    
    Route::post('send-pdf', [PdfUpload::class, 'pdfUpload'])->name('send-pdf');

    Route::post('search', [UserAuth::class,'search']);
});

//Health Center Login




//Admin Login





//Admin Spesific Functions
Route::get('register',[UserAuth::class, 'register'])->name('auth.register');  //Route will change
Route::post('registerUser',[UserAuth::class,'createUser']);


//Dont forget to delete createAdmin files
Route::get('admincreate',[UserAuth::class,'goAdmin'])->name('auth.admin');
Route::post('adminC',[UserAuth::class,'createAdmin']);

