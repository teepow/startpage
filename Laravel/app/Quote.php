<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model {

	protected $fillable = [
		'quote',
		'author',
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

}
