<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model {

	protected $fillable = [
		'posts',
	];

	/**
	 * Facebook belongs to User
	 * 
	 * @return BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

}
