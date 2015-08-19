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
	 * @return redirect /
	 */
	public function update()
	{
		session_start();
		FacebookSession::setDefaultApplication(env('FACEBOOK_CLIENT_ID'), env('FACEBOOK_CLIENT_SECRET'));

		$helper = new FacebookRedirectLoginHelper('http://startpage.com/facebook/update');

		try 
		{
			$session = $helper->getSessionFromRedirect();
			$request = new FacebookRequest($session, 'GET', '/me/posts');
		} 
		catch(FacebookRequestException $e) 
		{
			return Redirect::to('/'); 
		}
		 catch(\Exception $e) 
		{
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
	 */
	public function delete()
	{
		if (Auth::user()->facebooks()->count() > 0)
		{
			DB::table('facebooks')->delete(Auth::user()->user_id);
		}
	}

	/**
	 * Store new posts in facebooks
	 * 
	 * @param  $graphObject
	 */
	public function store($graphObject)
	{
		foreach($graphObject as $data)
		{
			if(isset($data->message))
			{
				$facebook = new Facebook;
				$facebook->post = $data->message;

				Auth::user()->facebooks()->save($facebook);
			}
		}
	}

}
