<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\ToDo;
use App\User;

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

			return view('pages.home', compact('todos', 'quote', 'images', 'author'));
		}
		return view('auth.login');
	}

}
