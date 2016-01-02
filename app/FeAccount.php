<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class FeAccount extends Model {

	protected $table = 'fe_accounts';

	public function authme() {
		return $this->belongsTo('App\Authme', 'name', 'username');
	}
}

?>