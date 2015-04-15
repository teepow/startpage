<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PreparePhotoRequest;

use Illuminate\Http\Request;
use App\Photo;

class PhotosController extends Controller {

	/**
	 * Create new Photo instance and apply middleware for authentication
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show page to edit photos
	 * 
	 * @return photos/edit
	 */
	public function edit()
	{
		return view('photos.edit');
	}

	public function store(PreparePhotoRequest $request)
	{
		$file = $request->file('file');

		$file->move(public_path() . '/images');

		$path = '/images' . $file;

		//remove tmp directory from path (don't know where it comes from)
		$path = str_replace('/tmp', '', $path);

		$photo = new Photo;
		$photo->image = $path;

		\Auth::user()->photos()->save($photo);

		return Redirect('/');
	}

}
