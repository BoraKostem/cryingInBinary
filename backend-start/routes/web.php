<?php

use App\Http\Controllers\MainController;
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


//Login

Route::post('user',[UserAuth::class,'userLogin']);



Route::group(['middleware'=>['authCheck']], function(){
    Route::get('login',[UserAuth::class,'login'])->name('auth.login');
    
    
    
    Route::get('auth/logout',[UserAuth::class,'logout'])->name('auth.logout'); //Logout

    //Pages
    Route::get('dashboard',[UserAuth::class,'dashboard'])->name('home'); //Dashboard of the users
    Route::get('profile',[UserAuth::class,'profilePage'])->name('user.profile'); //Profile page for users except admin
    Route::get('profile/edit',[UserAuth::class,'profileEdit'])->name('user.profile.edit');
    Route::post('edtPrfl', [MainController::class,'editProfile'])->name('edtPrflInf');//Post method for edditing profile 
    Route::post('edtPrflStaff', [MainController::class,'editProfileStaff'])->name('edtPrflInfStaff'); //Post method for edditing profile of staff

    //Admin Spesific Functions
    Route::get('manage',[UserAuth::class, 'manageUser'])->name('manageUser'); //User management page
    Route::post('delPatient',[UserAuth::class, 'deletePatient'])->name('delPatient'); //Delete Patient Model
    Route::post('delStaff',[UserAuth::class, 'deleteStaff'])->name('delStaff'); //Delete Staff Model
    Route::get('register',[UserAuth::class, 'register'])->name('auth.register');  //Route will change
    Route::get('register/staff',[UserAuth::class, 'registerStaff'])->name('auth.register.staff');  //Route will change
    Route::post('registerUser',[UserAuth::class,'createUser']);
    Route::post('registerStaff',[UserAuth::class,'createStaff'])->name('register.staff');;
    Route::post('chngnws',[MainController::class,'changeNews']); //Admin Change News   -- todo protect for admin

});

Route::any('{query}',[UserAuth::class,'no404'])
    ->where('query', '.*');
//Health Center Login




//Admin Login





//Admin Spesific Functions



//Dont forget to delete createAdmin files
Route::get('admincreate',[UserAuth::class,'goAdmin'])->name('auth.admin');
Route::post('adminC',[UserAuth::class,'createAdmin']);
