<?php

use App\Http\Controllers;
use App\Http\Middleware;

Route::get('/', function () {
    return view('index');
});


Route::fallback(function () {
    return 'not found';
});


Route::prefix('categories')->group(function () {
    Route::get('', 'CategoryController@index');
    Route::get('create', 'CategoryController@create')->middleware('auth');
    Route::post('store', 'CategoryController@store')->middleware('auth');
    Route::get('{id}', 'CategoryController@show');
    Route::get('edit/{id}', 'CategoryController@edit')->middleware('auth');
    Route::put('update/{id}', 'CategoryController@update')->middleware('auth');
    Route::delete('destroy/{id}', 'CategoryController@destroy')->middleware('auth');
});

Route::prefix('products')->group(function () {
    Route::get('', 'ProductController@index');
    Route::get('create', 'ProductController@create')->middleware('auth');
    Route::post('store', 'ProductController@store')->middleware('auth');
    Route::get('{id}', 'ProductController@show');
    Route::get('edit/{id}', 'ProductController@edit')->middleware('auth');
    Route::put('update/{id}', 'ProductController@update')->middleware('auth');
    Route::delete('destroy/{id}', 'ProductController@destroy')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
