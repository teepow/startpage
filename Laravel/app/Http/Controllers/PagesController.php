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
			exec("/usr/games/fortune", $fortune);

			$todos = \Auth::user()->todos->where('content_removed', 0);

			$images = \Auth::user()->photos;

			return view('pages.home', compact('todos', 'fortune', 'images'));
		}
		return view('auth.login');
	}

}
