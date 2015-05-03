<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrepareFavoriteRequest;

use Auth;
use App\Favorite;
use Redirect;
use DB;

use Illuminate\Http\Request;

class FavoritesController extends Controller {

	/**
	 * Create new favorite instance and apply middleware for authentication
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show page to edit favorites
	 * 
	 * @return links/favorites
	 */
	public function edit()
	{
		$favorites = Auth::user()->favorites;

		return view('favorites.edit', compact('favorites'));
	}

	/**
	 * If less than 4 favorites exist, store favorite in DB
	 * 
	 * @param  PrepareFavoriteRequest $request
	 * ]
	 * @return Redirect back to favorites/edit
	 */
	public function store(PrepareFavoriteRequest $request)
	{
		if (Auth::user()->favorites()->count() >= 4) 
		{
			return Redirect::back()->withErrors(['You may only use 4 favorites. Please remove a favorite and try again']);
		}

		$favorite = new Favorite;

		$favorite->link = $request->link;
		$favorite->name = $request->name;

		Auth::user()->favorites()->save($favorite);

		return Redirect::back();
	}

	/**
	 * Remove favorite from DB
	 * 
	 * @param  $favoriteId 
	 * 
	 * @param  Request $request 
	 * 
	 * @return Redirect back to favorites/edit
	 */
	public function update($favoriteId, Request $request)
	{
		DB::table('favorites')->delete($favoriteId);

		return Redirect::back();
	}
}
