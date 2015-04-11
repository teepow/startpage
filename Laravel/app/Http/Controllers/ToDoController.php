<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\PrepareToDoRequest;

class ToDoController extends Controller {

	/**
	 * Create new ToDo instance and apply middleware for authentication
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show all todos
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		return 'all todos';
	}

	/**
	 * Show page to create todos
	 * 
	 * @return todos/create
	 */
	public function create()
	{
		return view('todos.create');
	}

	/**
	 * Confirm new ToDo
	 * 
	 * @param  PrepareToDoRequest $request 
	 * 
	 * @return  pages/home
	 */
	public function confirm(PrepareToDoRequest $request)
	{
		return view('pages.home');
	}

}
