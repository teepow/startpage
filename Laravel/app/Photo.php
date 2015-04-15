<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

	protected $fillable = [
		'image'
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
