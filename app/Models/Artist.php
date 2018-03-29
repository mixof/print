<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Artist extends Model {

	use SoftDeletes;
	use Sluggable;
	use SluggableScopeHelpers;

	protected $dates = ['deleted_at'];

	protected $fillable = ['user_id', 'display_name',
		'first_name', 'last_name', 'email', 'phone', 'bio', 'paypal_email', 'middle_name', 'deactive_account'];

	protected $appends = ['photo_url'];

	protected static $rules = [
		'display_name'	=> 'required',
		'first_name'	=> 'required',
		'last_name'		=> 'required',
		'email'			=> 'required|email',
		'paypal_email'	=> 'required|email',
		'phone'			=> 'required',
	];

    public static function removePhoto($id) {
        DB::statement('UPDATE artists SET photo = NULL WHERE id = ' . $id);
    }

	public static function boot() {
		parent::boot();

		// Remove old image files from file system on update
		static::updated(function ($artist) {
			if ($artist->isDirty('photo')) {
				$upload_dir = public_path() . '/uploads/artists/';

				File::delete($upload_dir . $artist->getOriginal('photo'));
			}
		});

		// Remove image files from file system on delete
		static::deleted(function ($artist) {
			$upload_dir = public_path() . '/uploads/artists/';

			Storage::delete($upload_dir . $artist->photo);
		});
	}

	public function user() {
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function photos() {
		return $this->hasMany('App\Models\Photo');
	}

	public function getPhotoUrlAttribute($value) {
		return asset('uploads/artists/' . $this->photo);
	}

	public function sluggable() {
		return [
			'slug' => [
				'source' => 'display_name'
			]
		];
	}
}
