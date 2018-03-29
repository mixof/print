<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ImageType extends Model {

    use Sluggable;

    public $timestamps = false;

    protected $fillable = ['name'];

    protected static $rules = [
        'name' => 'required'
    ];

    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}