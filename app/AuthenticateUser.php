<?php namespace App;

use Laravel\Socialite\Contracts\Factory as Socialite;
use App\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateUser {

	private $users;

	private $socialite;

	private $auth;

	public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
	{
		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;
	}

	public function execute($hasCode, $provider)
	{
		if (!$hasCode) return $this->getAuthorizationFirst($provider);

		$user = $this->users->findByUsernameOrCreate($this->getProviderUser($provider));

		if(!$user) return redirect('/')->withErrors(['That email is already in use by another user']);

		$this->auth->login($user, true);

		return redirect('/');
	}

	/**
	 * Redirect to OAuth provider
	 * 
	 * @return 
	 */
	private function getAuthorizationFirst($provider)
	{
		return $this->socialite->driver($provider)->redirect();
	}

	/**
	 * Recieve callback from provider
	 * 
	 * @return
	 */
	private function getProviderUser($provider)
	{
		return $this->socialite->driver($provider)->user();
	}
}