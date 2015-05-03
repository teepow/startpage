<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * A user may have many todos
	 * 
	 * @return HasMany
	 */
	public function todos()
	{
		return $this->hasMany('App\ToDo');
	}

	/**
	 * A user may have many photos
	 * 
	 * @return HasMany
	 */
	public function photos()
	{
		return $this->hasMany('App\Photo');
	}

	/**
	 * A user may have one quote
	 * 
	 * @return HasOne
	 */
	public function quotes()
	{
		return $this->hasOne('App\Quote');
	}

	/**
	 * A user may have many facebook
	 * 
	 * @return HasMany
	 */
	public function facebooks()
	{
		return $this->hasMany('App\Facebook');
	}

	/**
	 * A user may have many favorites
	 * 
	 * @return HasMany
	 */
	public function favorites()
	{
		return $this->hasMany('App\Favorite');
	}
}
