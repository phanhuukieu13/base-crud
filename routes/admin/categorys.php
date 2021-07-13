<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'middleware'=> 'checklogin::class'], function() {

    Route::group(['prefix' => 'cates', 'as' => 'cates.'], function() {

        Route::get('/','CategoryController@index')->name('index');
        Route::get('/create','CategoryController@create')->name('create');
        Route::post('/store','CategoryController@store')->name('store');
        Route::get('/edit/{id}','CategoryController@edit')->name('edit');
        Route::post('/update','CategoryController@update')->name('update');
        Route::post('/destroy/{id}','CategoryController@destroy')->name('destroy');
    });

});