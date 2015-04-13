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
 * Authentication
 */
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
