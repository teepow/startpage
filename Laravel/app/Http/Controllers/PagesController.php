<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\ToDo;
use App\User;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Redirect;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function home($graphObject = NULL)
	{
		if(Auth::check())
		{
			if (Auth::user()->quotes()->count() > 0) 
			{
				$quote[] = Auth::user()->quotes->quote;
				$author = Auth::user()->quotes->author;
			} 
			else 
			{
				exec("/usr/games/fortune", $quote);
				$author = NULL;
			}
			

			$todos = Auth::user()->todos->where('content_removed', 0);

			$images = Auth::user()->photos;

			$loginUrl = ($graphObject) ? NULL : $this->getLogin();

			return view('pages.home', compact('todos', 'quote', 'images', 'author', 'loginUrl', 'graphObject'));
		}
		return view('auth.login');
	}

	public function getLogin()
	{
		session_start();
		FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));
		
		$helper = new FacebookRedirectLoginHelper('http://startpage.app/facebook/confirm');
		$loginUrl = $helper->getLoginUrl();

		return $loginUrl;
	}

	public function facebookConfirm()
	{
		session_start();
		FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));

		$helper = new FacebookRedirectLoginHelper('http://startpage.app/facebook/confirm');

		// try {
			$session = $helper->getSessionFromRedirect();
			$request = new FacebookRequest($session, 'GET', '/me/posts');
		// } catch(FacebookRequestException $e) {
		// 	return Redirect::to('/'); 
		// } catch(\Exception $e) {
		// 	return Redirect::to('/'); 
		// }
		
		$request = new FacebookRequest($session, 'GET', '/me/posts');
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		$graphObject = $graphObject->asArray();
		$graphObject = ($graphObject) ? $graphObject['data'] : 'No Messages to Show';

		return $this->home($graphObject);
	}

}
