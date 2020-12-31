<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/foods', 'FoodController@index');
Route::post('/foods/', 'FoodController@store');
Route::get('/foods/{id}', 'FoodController@show');
Route::put('/foods/{id}', 'FoodController@update');
Route::delete('/foods/{id}', 'FoodController@destroy');

Route::get('/carts', 'CartController@index');
Route::post('/carts/', 'CartController@store');
Route::put('/carts/{id}', 'CartController@update');
Route::delete('/carts/{id}', 'CartController@destroy');

Route::get('/orders', 'OrderController@index');
Route::post('/orders/', 'OrderController@store');
Route::get('/orders/{id}', 'OrderController@show');
// Route::put('/orders/{id}', 'OrderController@update');
Route::delete('/orders/{id}', 'OrderController@destroy');