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
 * Facebook Login
 */
Route::get('login/facebook', 'Auth\AuthController@facebookLogin');


Route::get('facebook/confirm', 'PagesController@facebookConfirm');






Route::get('/info', function() {
	phpinfo();
} );
