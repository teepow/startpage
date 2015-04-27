<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Redirect;
use Auth;
use App\Facebook;
use DB;

use Illuminate\Http\Request;

class FacebooksController extends Controller {
	/**
	 * Update facebooks table
	 * 
	 * @return [type] [description]
	 */
	public function update()
	{
		session_start();
		FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));

		$helper = new FacebookRedirectLoginHelper('http://startpage.app/facebook/update');

		try {
			$session = $helper->getSessionFromRedirect();
			$request = new FacebookRequest($session, 'GET', '/me/posts');
		} catch(FacebookRequestException $e) {
			return Redirect::to('/'); 
		} catch(\Exception $e) {
			return Redirect::to('/'); 
		}
		
		$request = new FacebookRequest($session, 'GET', '/me/posts?limit=10');
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		$graphObject = $graphObject->asArray();
		if ($graphObject) $graphObject = $graphObject['data'];

		$this->delete();
		if(is_array($graphObject)) $this->store($graphObject);

		return redirect('/');
	}

	/**
	 * Check if user has facebooks and delete if they do
	 * 
	 * @return bool
	 */
	public function delete()
	{
		if (Auth::user()->facebooks()->count() > 0)
		{
			return DB::table('facebooks')->delete(Auth::user()->user_id);
		}
		return false;
	}

	/**
	 * Store new posts in facebooks
	 * 
	 * @param  $graphObject
	 *  
	 * @return bool
	 */
	public function store($graphObject)
	{
		foreach($graphObject as $data)
		{
			$facebook = new Facebook;
			$facebook->post = $data->message;

			return Auth::user()->facebooks()->save($facebook);
		}
	}

}
