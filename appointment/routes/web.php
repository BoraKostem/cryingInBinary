<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctorcontroller;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FrontendController;
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


Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);

Route::get('/new-appointment/{doctorId}/{date}', 'App\Http\Controllers\FrontendController@show')
->name('create.appointment');

Route::post('/book/appointment','App\Http\Controllers\FrontendController@store')->name('booking.appointment')
->middleware('auth');

Route::get('/my-booking','App\Http\Controllers\FrontendController@myBookings')->name('my.booking')->middleware('auth');


Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>['auth','admin']],function(){
    Route::resource('doctor',DoctorController::class);
});

Route::group(['middleware'=>['auth','doctor']],function(){
    Route::resource('appointment',AppointmentController::class);
    Route::post('/appointment/check','App\Http\Controllers\AppointmentController@check')->name('appointment.check');
    Route::post('/appointment/update','App\Http\Controllers\AppointmentController@updateTime')->name('update');
});