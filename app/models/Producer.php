<?php

class Producer extends Eloquent {
	protected $table = 'producers';

	public function products() {
		$this->hasMany('Product');
	}
}