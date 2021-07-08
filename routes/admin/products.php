<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::group(['prefix' => 'pros', 'as' => 'pros.'], function() {

        Route::get('/','ProductController@index')->name('index');
        Route::get('/create','ProductController@create')->name('create');
        Route::post('/store','ProductController@store')->name('store');
        Route::get('/edit/{id}','ProductController@edit')->name('edit');
        Route::post('/update/{id}','ProductController@update')->name('update');
        Route::post('/destroy/{id}','ProductController@destroy')->name('destroy');
        Route::get('/search','ProductController@search')->name('search');
    });

});