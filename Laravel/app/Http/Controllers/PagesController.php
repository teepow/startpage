<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\ToDo;
use App\User;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Redirect;

use Illuminate\Http\Request;

class PagesController extends Controller {

	
	public function home()
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

			$facebooks = (Auth::user()->facebooks->first()) ? Auth::user()->facebooks : 'No Messages to Show';

			$favorites = Auth::user()->favorites;

			$loginUrl = $this->getLogin();

			return view('pages.home', compact('todos', 'quote', 'images', 'author', 'loginUrl', 'facebooks', 'favorites'));
		}
		return view('auth.login');
	}

	/**
	 * Get url from Facebook API
	 * 
	 * @return String
	 */
	public function getLogin()
	{
		session_start();
		FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));
		
		$helper = new FacebookRedirectLoginHelper('http://startpage.com/facebook/update');
		$loginUrl = $helper->getLoginUrl();

		return $loginUrl . 'user_posts';
	}
}
