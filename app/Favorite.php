<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {

	protected $fillable = [
		'link'
	];

	/**
	 * Photo belongs to user
	 * 
	 * @return BelongsTo
	 */
	 public function user()
	 {
	 	return $this->belongsTo('User');
	 }

}
