<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Storage;

class Photo extends Model {

	use SoftDeletes;
	use Sluggable;
	use SluggableScopeHelpers;
    use \App\Http\Traits\SortableTrait;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['artist_id', 'category_id', 'title', 'description', 'tags', 'orientation', 'price', 'large_file', 'preview_file', 'thumbnail_file','hide_photo', 'meta_name', 'meta_keywords', 'meta_description', 'image_type_id', 'exclude_homepage', 'sort_order'];

	protected $appends = ['large_file_url', 'preview_file_url', 'thumbnail_file_url'];

	protected static $rules = [
		'large_file'		=> 'required',
		'orientation'		=> 'required|in:portrait,landscape',
		'title'				=> 'required',
		'artist_id'			=> 'required',
		'category_id'		=> 'required',
		'image_type_id'		=> 'required',
		'price'				=> 'required|numeric|min:1',
	];

	protected static $messages = [
		'large_file.required' => 'An image file is required.'
	];

	public static function boot() {
		parent::boot();

		// Remove old image files from file system on update
		static::updated(function ($photo) {
			if ($photo->isDirty('large_file')) {
				$upload_dir = public_path() . '/uploads/';

				Storage::delete($upload_dir . $photo->getOriginal('large_file'));
				Storage::delete($upload_dir . $photo->getOriginal('preview_file'));
				Storage::delete($upload_dir . $photo->getOriginal('thumbnail_file'));
			}
		});

		// Remove image files from file system on delete
		static::deleted(function ($photo) {
			$upload_dir = public_path() . '/uploads/';

			Storage::delete($upload_dir . $photo->large_file);
			Storage::delete($upload_dir . $photo->preview_file);
			Storage::delete($upload_dir . $photo->thumbnail_file);
		});
	}

	public function artist() {
		return $this->belongsTo('App\Models\Artist');
	}

	public function category() {
		return $this->belongsTo('App\Models\Category');
	}

	public function imageType() {
		return $this->belongsTo('App\Models\ImageType');
	}

	public function orders() {
		return $this->hasMany('App\Models\Order');
	}

	public function scopeInImageType($query, $imageTypeId) {
		return $query->whereHas('imageType', function($q) use ($imageTypeId) {
			$q->where('image_type_id', '=', $imageTypeId);
		});
	}
	
	public function scopeInCategory($query, $categoryId) {
		return $query->where('category_id','LIKE','%,'.$categoryId.',%')
				->orWhere('category_id','LIKE',$categoryId)
				->orWhere('category_id','LIKE','%,'.$categoryId)
				->orWhere('category_id','LIKE',$categoryId.',%');
	}

	public function scopeInCategoryOrIsChild($query, $slug, $id) {
		return $query->whereHas('category', function($q) use ($slug) {
			$q->where('slug', '=', $slug);
		})->orWhereHas('category', function($q) use($id) {
			$q->where('parent_id', '=', $id);
		});
	}

	public function scopeIsPriced($query, $min, $max = null) {
		if (!$max) {
			return $query->where('price', '>=', $min);
		}
		return $query->whereBetween('price', [$min, $max]);
	}

	public function scopeSearch($query, $keywords) {
//		return $query->where('title', 'LIKE', "%{$keywords}%")
//                     ->orWhere('tags', 'LIKE', "%{$keywords}%");

		return $query->where(function ($query) use ($keywords) {
			$query->where('title', 'LIKE', "%{$keywords}%")
				  ->orWhere('tags', 'LIKE', "%{$keywords}%");
		});
	}

	public function getLargeFileUrlAttribute($value) {
		return asset('uploads/' . $this->large_file);
	}

	public function getPreviewFileUrlAttribute($value) {
		return asset('uploads/' . $this->preview_file);
	}

	public function getThumbnailFileUrlAttribute($value) {
		return asset('uploads/' . $this->thumbnail_file);
	}

	public function sluggable() {
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
    public function getCategoryIdAttribute($value)
    {
        return explode(',',$value);
    }
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = implode(',',$value);
    }
    public function nextPrevLinks()
    {
		$q = Photo::where('artist_id',$this->artist_id)->whereNull('deleted_at')->where('hide_photo','0');
		$count = $q->count();
		if($count == 1){
			$next = $prev = $this->slug;
		}elseif($count == 2){
			$next = $prev = $q->where('id','!=',$this->id)->first()->slug;
		}else{
			$ids = $q->orderBy('sort_order','ASC')->orderBy('id','ASC')->get(['id','slug'])->toArray();
			$key = array_search($this->id,array_column($ids,'id'));
			$prev = $ids[($key-1+$count)%$count]['slug'];
			$next = $ids[($key+1+$count)%$count]['slug'];
		}
        return ['next' => $next,'prev'=>$prev];
    }

}
