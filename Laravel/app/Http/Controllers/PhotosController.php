<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PreparePhotoRequest;

use Illuminate\Http\Request;
use App\Photo;
use Image;
use Auth;
use Redirect;
use DB;

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
		$images = Auth::user()->photos;

		return view('photos.edit', compact('images'));
	}

	/**
	 * save image to public/images and store location in DB
	 * 
	 * @param  PreparePhotoRequest $request 
	 * 
	 * @return Redirect back to photos/edit
	 */
	public function store(PreparePhotoRequest $request)
	{
		if (Auth::user()->photos()->count() >= 4) 
		{
			return Redirect::back()->withErrors(['You may only upload 4 images. Please delete an image and try again']);
		}

		$file = $this->resizeImage($request);

		$path = '/images/' . date('Y-m-d H:i:s');

		$file->save(public_path() . $path);

		$photo = new Photo;

		$photo->image = $path;

		Auth::user()->photos()->save($photo);

		return Redirect::back();
	}

	/**
	 * Resize image to 200 x 200
	 * 
	 * @param  request 
	 * 
	 * @return file
	 */
	public function resizeImage($request)
	{
		$file = $request->file('file');

		$file = Image::make(file_get_contents($file));

		$file->resize(200, 200);

		return $file;
	}

	/**
	 * Remove file from disk and record from DB
	 * 
	 * @param  $photoId 
	 * 
	 * @param  Request $request
	 *  
	 * @return Redirect back to photos/edit          
	 */
	public function update($photoId, Request $request)
	{
		$path = DB::table('photos')->where('id', $photoId)->pluck('image');

		\File::delete(public_path() . $path);

		DB::table('photos')->delete($photoId);

		return Redirect::back();
	}

}
