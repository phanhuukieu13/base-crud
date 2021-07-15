<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'middleware'=> 'checklogin::class'], function() {

    Route::group(['prefix' => 'pros', 'as' => 'pros.'], function() {

        Route::get('/','ProductController@index')->name('index');
        Route::get('/create','ProductController@create')->name('create');
        Route::post('/store','ProductController@store')->name('store');
        Route::get('/edit/{id}','ProductController@edit')->name('edit');
        Route::post('/update','ProductController@update')->name('update');
        Route::post('/destroy/{id}','ProductController@destroy')->name('destroy');
        Route::get('/search','ProductController@search')->name('search');
        Route::post('DeActive/{id}', 'ProductController@DeActive')->name('DeActive');
        Route::post('active/{id}', 'ProductController@Active')->name('active');
        Route::post('deleteAll', 'ProductController@deleteMultiple')->name('deleteAll');
    });

});