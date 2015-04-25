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





Route::get('/info', function() {
	phpinfo();
} );

Route::get('/testing', function() {
	if (Auth::check())
		return 'Welcome back, ' . Auth::user()->username;

	return 'Hi guest' . link_to('testingTwo', 'Login With Github');
});

Route::get('testingTwo', 'Auth\AuthController@testingLogin');