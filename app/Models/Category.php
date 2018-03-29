<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Category extends Model {

	use Sluggable;
	use SluggableScopeHelpers;

	public $timestamps = false;

	protected $fillable = ['parent_id', 'name'];

	protected static $rules = [
		'name' => 'required'
	];

	public function photos() {
		return $this->hasMany('App\Models\Photo');
	}

	public function imageTypes() {
		return $this->belongsToMany('App\Models\ImageType');
	}

	public function parent() {
		return $this->belongsTo('App\Models\Category', 'parent_id');
	}

	public function children() {
		return $this->hasMany('App\Models\Category', 'parent_id')->with('photos');
	}

	public function isParent() {
		return $this->where('parent_id', '==', 0);
	}

	public function isChild() {
		return $this->where('parent_id', '>', 0);
	}

	public function sluggable() {
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}
}
