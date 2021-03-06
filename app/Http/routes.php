<?php

/**
 * Home Page
 */
Route::get('/', 'PagesController@home');

/**
 * ToDos
 */
Route::get('todos/create/confirm', 'ToDoController@confirm');
Route::get('todos/create', 'ToDoController@create');
Route::post('todos/store', 'ToDoController@store');
Route::patch('todos/{todos}', 'ToDoController@update');

/**
 * Photos
 */
Route::get('photos/edit', 'PhotosController@edit');
Route::post('photos/store', 'PhotosController@store');
Route::patch('photos/{photos}', 'PhotosController@update');

/**
 * Quotes
 */
Route::get('quotes/edit', 'QuotesController@edit');
Route::post('quotes/store', 'QuotesController@store');

/**
 * Authentication
 */
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/**
 * Facebook API
 */
Route::get('facebook/update', 'FacebooksController@update');

/**
 * Facebook Login
 */
Route::get('login/facebook', 'Auth\AuthController@facebookLogin');

/**
 * Google Login
 */
Route::get('login/google', 'Auth\AuthController@googleLogin');

/**
 * Favorites
 */
Route::get('favorites/edit', 'FavoritesController@edit');
Route::post('favorites/store', 'FavoritesController@store');
Route::patch('favorites/{favorites}', 'FavoritesController@update');



Route::get('/info', function() {
	phpinfo();
} );
