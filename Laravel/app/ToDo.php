<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model {

	protected $fillable = [
		'activity',
		'content_removed',
	];

	public static function open(array $attributes)
	{
		return new static($attributes);
	}

	/**
	 * ToDo belongs to user
	 * 
	 * @return BelongsTo
	 */
	 public function user()
	 {
	 	return $this->belongsTo('User');
	 }

}
