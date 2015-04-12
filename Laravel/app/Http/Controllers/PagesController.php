<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\ToDo;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function home()
	{
		if(Auth::check())
		{
			return view('pages.home');
		}
		return view('auth.login');
	}

}
