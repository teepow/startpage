<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;

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



Route::get('facebook/edit', function() {
	session_start();
	FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));
	
	$helper = new FacebookRedirectLoginHelper('http://startpage.app/facebook/login');
	$loginUrl = $helper->getLoginUrl();

	echo '<a href="' . $loginUrl . '">Log In</a>';

	//$helper = new FacebookRedirectLoginHelper($loginUrl);

	// try {
	//   $session = $helper->getSessionFromRedirect();
	//   dd($session);
	// } catch(FacebookRequestException $ex) {
	//   echo 'Facebook returns an error';
	// } catch(\Exception $ex) {
	//   echo 'validation fails or other local issues';
	// }
	// if (!$session) {
	//   echo 'Hello';
	// }

	// $request = new FacebookRequest($session, 'GET', '/me');
	// dd($request);
});

Route::get('facebook/login', function() {
	session_start();
	FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));

	$helper = new FacebookRedirectLoginHelper('http://startpage.app/facebook/login');

	$session = $helper->getSessionFromRedirect();
	
	$request = new FacebookRequest($session, 'GET', '/me/posts');
	$response = $request->execute();
	$graphObject = $response->getGraphObject();
	$graphObject = $graphObject->asArray();
	// dd($graphObject['data']);
	// echo $graphObject['data'][0]->message;
	
	foreach($graphObject['data'] as $data) {
		echo $data->message . '<br>';
	}
});





Route::get('/info', function() {
	phpinfo();
} );

// Route::get('/testing', function() {
// 	if (Auth::check())
// 		return 'Welcome back, ' . Auth::user()->name;

// 	return 'Hi guest' . link_to('testingTwo', 'Login With Github');
// });
