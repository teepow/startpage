<?php namespace App;

use App\User;

class UserRepository {
	
	public function findByUsernameOrCreate($userData)
	{
		try {
			return User::firstOrCreate([
				'name' => $userData->name,
				'email' => $userData->email,
			]);
		} catch (\Illuminate\Database\QueryException $e) {
			 return false;
		}
	}
}