<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'middleware'=> 'checklogin::class'], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

});