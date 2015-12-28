<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

	protected $table = 'topic';
	
	public function comment()
	{
		return $this->hasMany('App\Comment');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function category()
	{
		return $this->belongsTo('App\category');
	}

	public function canEdit()
	{
		return $this->id === auth()->user()->id || auth()->user()->is_admin();
	}
}

?>