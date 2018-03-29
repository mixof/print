<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	protected $fillable = ['photo_id', 'amount', 'paid', 'printed', 'hash'];

	protected static $rules = [];

	public function photo() {
		return $this->belongsTo('App\Models\Photo')->withTrashed();
	}
	
	public function artist() {
		return $this->belongsTo('App\Models\Artist');
	}

}
