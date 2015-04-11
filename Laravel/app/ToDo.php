<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model {

	protected $fillable = [
		'activity'
	];

	public static function open(array $attributes)
	{
		print_r($attributes);
		return new static($attributes);
	}

}
