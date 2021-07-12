<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get("send-email", [EmailController::class, "sendEmail"]);
Route::get('/register', 'Auth\LoginController@register')->name('register');
Route::post('/register', 'Auth\LoginController@storeUser');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'Auth\LoginController@home')->name('home');
Route::get('/forget-password', 'Auth\ForgotPasswordController@getEmail');
Route::post('/forget-password', 'Auth\ForgotPasswordController@postEmail')->name('forgotPassword');
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@getPassword')->name('getLink');
Route::post('/reset-password', 'Auth\ResetPasswordController@updatePassword')->name('updatePassword');

