<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model {

	protected $fillable = ['hash', 'artist_id'];

	protected static $rules = [];

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'signup_invites';
}
