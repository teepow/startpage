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