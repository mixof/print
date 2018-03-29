<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profane extends Model {

	protected $fillable = ['name'];

	protected static $rules = [];

	public $timestamps = false;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profane_words';

	public static function isRejected($value)
	{
		$words = Profane::all()->lists('name');

		foreach ($words as $word) {
			if (preg_match("/{$word}/i", $value)) {
				return $word;
			}
		}

		return false;
	}
}
