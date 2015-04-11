<?php

/**
 * Home Page
 */
Route::get('/', 'PagesController@home');

/**
 * ToDos
 */
Route::resource('todos', 'ToDoController');

/**
 * Authentication
 */
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
