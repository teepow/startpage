<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Http\Requests\PrepareToDoRequest;
use App\ToDo;

class ToDoController extends Controller {

	/**
	 * Create new ToDo instance and apply middleware for authentication
	 */
	public function __construct()
	{
		$this->middleware('auth');
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
	 * Store new ToDo
	 * 
	 * @param  PrepareToDoRequest $request 
	 * 
	 * @return  pages/home
	 */
	public function store(PrepareToDoRequest $request)
	{
		$data = $request->all();

		$todo = Todo::open($data);

		\Auth::user()->todos()->save($todo);

		return Redirect('/');
	}

	/**
	 * Update content_removed field
	 * 
	 * @param  string  $todoId  
	 * 
	 * @param  Request $request 
	 */
	public function update($todoId, Request $request)
	{
		$isRemoved = $request->has('content_removed');

		ToDo::findOrFail($todoId)
			->update(['content_removed' => $isRemoved]);

		//return redirect()->back();
	}

}
