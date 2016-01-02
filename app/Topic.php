<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

	protected $table = 'topic';

	private $newsId = 1;

	const BAN = -1;
	const ACTIVE = 1;
	const PIN = 2;
	const LOCK = 0;

	public function comment() {
		return $this->hasMany('App\Comment');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function category() {
		return $this->belongsTo('App\Category');
	}

	public function canEdit() {
		return ($this->user_id === auth()->user()->id && $this->status != self::LOCK) || auth()->user()->is_admin();
	}

	public function canReply() {
		return $this->status != self::LOCK && $this->status != self::BAN || auth()->user()->is_admin();
	}

	public function setBan() {
		$this->status = self::BAN;
	}

	public function setLock() {
		$this->status = self::LOCK;
	}

	public function setActive() {
		$this->status = self::ACTIVE;
	}

	public function setPin() {
		$this->status = self::PIN;
	}

	public function togglePin() {
		$this->status = $this->isPin() ? self::ACTIVE : self::PIN;
	}

	public function toggleLock() {
		$this->status = $this->isLock() ? self::ACTIVE : self::LOCK;
	}

	public function isPin() {
		return $this->status == self::PIN;
	}

	public function isLock() {
		return $this->status == self::LOCK;
	}

	public function scopeNews($query) {
		return $query->where('category_id', $this->newsId);
	}

	public function scopeActive($query) {
		return $query->where('status', '>=', 0);
	}
}

?>