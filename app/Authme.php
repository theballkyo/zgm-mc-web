<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Authme extends Model {

	protected $table = 'authme';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password', 'ip', 'lastlogin',
	];

	public function fe() {
		return $this->hasOne('App\FeAccount', 'name', 'username');
	}
}

?>