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
		exec("/usr/games/fortune", $fortune);

		if(Auth::check())
		{
			$todos = \Auth::user()->todos->where('content_removed', 0);

			return view('pages.home', compact('todos', 'fortune'));
		}
		return view('auth.login');
	}

}
