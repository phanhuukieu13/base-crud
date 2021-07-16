<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'middleware'=> 'checklogin::class'], function() {

    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {

        Route::get('/','UserController@index')->name('index');

        Route::get('/create','UserController@create')->name('create');
        Route::post('/uploadFile', 'UserController@uploadFile')->name('uploadFile');
        Route::post('/store', 'UserController@store')->name('store');
        
        Route::get('/edit/{id}','UserController@edit')->name('edit');

        Route::post('update', 'UserController@update')->name('update');

        Route::post('destroy/{id}', 'UserController@destroy')->name('destroy');
        Route::get('/search','UserController@search')->name('search');
        Route::post('deActive/{id}', 'UserController@deActive')->name('deActive');
        Route::post('deleteAll', 'UserController@deleteMultiple')->name('deleteAll');
    });

});