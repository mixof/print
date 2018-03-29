<?php

namespace Admin;

use BaseController, App\Models\Photo, App\Models\Artist, App\Models\Category, App\Models\ImageType, Illuminate\Support\Facades\Input, Illuminate\Http\Request, View, Redirect, Webpatser\Uuid\Uuid, Intervention\Image\Facades\Image, DB;

class PhotoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$search = $request->input('s');
		if ($search != 'title') {
			$photoList = DB::table('photos')
						->join('artists'    , 'photos.artist_id'  , '=', 'artists.id')
						->join('image_types', 'photos.image_type_id', '=', 'image_types.id')
						->orderBy('title', 'ASC')
						->whereNull('photos.deleted_at')
						->select(
							'photos.id',
							'photos.title',
							'photos.artist_id',
							'photos.category_id as category_id',
							'photos.updated_at',
							'artists.display_name as display_name',
							'image_types.name as image_type_name',
							'photos.price',
							'photos.hide_photo',
							'photos.exclude_homepage'
						)->get();

		} else {
			$photoList = DB::table('photos')
						->join('artists'    , 'photos.artist_id'  , '=', 'artists.id')
						->join('image_types', 'photos.image_type_id', '=', 'image_types.id')
						->whereNull('photos.deleted_at')
						->select(
							'photos.id',
							'photos.title',
							'photos.artist_id',
							'photos.category_id as category_id',
							'photos.updated_at',
							'artists.display_name as display_name',
							'image_types.name as image_type_name',
							'photos.price',
							'photos.hide_photo',
							'photos.exclude_homepage'
						)->get();

		}
		$categories = [];
		$categoriesCollection = Category::get(['id','name']);
		foreach($categoriesCollection as $category){
			$categories[$category->id] = $category->name;
		}
		foreach($photoList as $key => $photo) {
			$photo_categories = [];
			foreach(explode(',',$photo->category_id) as $category_id){
				if(isset($categories[$category_id]))
				$photo_categories[] = $categories[$category_id];
			}
			$photo->category_name = '<ul><li>'.implode('</li><li>',$photo_categories).'</li></ul>';
			$photoList[$key] = $photo;
		}
    	return View::make('admin.photo.index', compact('photoList'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$artistList = Artist::orderBy('display_name')->lists('display_name', 'id');
		$categoryList = Category::orderBy('name')->lists('name', 'id');
		$imageTypeList = ImageType::orderBy('name')->lists('name', 'id');
		$path = $_SERVER["DOCUMENT_ROOT"].'/public/img/watermarks/';
		if(file_exists($path) && is_dir($path)){
			$result = scandir($path);	
			$files = array_diff($result, array('.', '..'));
			if(count($files) > 0){
				$n = 0;
				foreach($files as $file){
                if(is_file("$path/$file")){
									$filenamelist[$n] = $file;
									$n++;
								}
				}
			}
		}else{
			echo "ERROR: The directory does not exist.";
		}
		return View::make('admin.photo.create', compact('artistList', 'categoryList', 'imageTypeList', 'filenamelist'));
	}
	
	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $artistId = $request->input('artist_id');
			$title = $request->input('title');

			if($this->findDuplicate($artistId, $title)) {
					return \Illuminate\Support\Facades\Redirect::back()->withErrors('An image with this title already exists for this artist. Please modify the title or check the artist.')->withInput();
			}

			if ($request->hasFile('file')) {
			$photo = Photo::create($request->all());
			$files = $this->handleUpload($request);

			$photo->large_file = $files['large'];
			$photo->preview_file = $files['preview'];
			$photo->thumbnail_file = $files['thumbnail'];

			if ($photo->save()) {
					return Redirect::route('admin.photo.index')->with('success', 'Photo saved.');
			}
			} else {
		    return Redirect::back()->withErrors('Could not find file after uploading. Check the filename to see if it contains illegal characters or if the file was over 40MB.')->withInput();
			}

			return Redirect::back()->withErrors($photo->getErrors())->withInput();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$photo = Photo::findOrFail($id);
		$artistList = Artist::orderBy('display_name')->lists('display_name', 'id');
		$categoryList = Category::orderBy('name')->lists('name', 'id');
		$imageTypeList = ImageType::orderBy('name')->lists('name', 'id');
		$path = $_SERVER["DOCUMENT_ROOT"].'/public/img/watermarks/';
		if(file_exists($path) && is_dir($path)){
			$result = scandir($path);	
			$files = array_diff($result, array('.', '..'));
			if(count($files) > 0){
				$n = 0;
				foreach($files as $file){
                if(is_file("$path/$file")){
									$filenamelist[$n] = $file;
									$n++;
								}
				}
			}
		}else{
			echo "ERROR: The directory does not exist.";
		}
		return View::make('admin.photo.edit', compact('photo', 'artistList', 'categoryList', 'imageTypeList', 'filenamelist'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        $photo = Photo::findOrFail($id);
        if($photo->title != $request->title) {
            $photo->slug = null;
            $artistId = $request->input('artist_id');
            $title = $request->input('title');

            if($this->findDuplicate($artistId, $title)) {
                return \Illuminate\Support\Facades\Redirect::back()->withErrors('An image with this title already exists for this artist. Please modify the title or check the artist.')->withInput();
            }
        }

		$photo->fill($request->all());

		if ($request->hasFile('file')) {
			$files = $this->handleUpload($request);

			$photo->large_file = $files['large'];
			$photo->preview_file = $files['preview'];
			$photo->thumbnail_file = $files['thumbnail'];

		} else if ($request->input('watermark_regenerate')) {
            $photo = $this->regenerateWatermark($photo, $request);
        }
		
		if ($photo->save()) {
			return Redirect::route('admin.photo.index')->with('success', 'Photo updated.');
		}

		return Redirect::back()->withErrors($photo->getErrors())->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Photo::destroy($id);
		return Redirect::route('admin.photo.index')->with('success', 'Photo deleted.');
	}
	
	/**
	 * Hide the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function hide($id)
	{
		$photo = Photo::find($id);
		$photo->hide_photo = $photo->hide_photo == 0 ? 1 : 0;
		if ($photo->save()) {
			return Redirect::route('admin.photo.index')->with('success', 'Photo Updated.');
		}
	}

	private function findDuplicate($artist_id, $title) {
	    $image = Photo::where([
	        ['artist_id', $artist_id],
            ['title', $title]
        ])->first();
        return count($image);
    }


	private function handleUpload(Request $request) {
		$upload_dir = public_path() . '/uploads/';
		$file = $request->file('file');

		$filenames = [
			'large' => Uuid::generate(4) . '_L.' . $file->getClientOriginalExtension(),
			'preview' => Uuid::generate(4) . '_P.' . $file->getClientOriginalExtension(),
			'thumbnail' => Uuid::generate(4) . '_T.' . $file->getClientOriginalExtension()
		];

		$img = Image::make($file->getRealPath());

        $watermark = $this->readWatermark($request);

		// Resize and add border for printing
        $print_w = ($img->width() > $img->height()) ? 3175 : 2475;
        $print_h = ($img->width() > $img->height()) ? 2475 : 3175;

		$img->backup()
			->resize($print_w, $print_h, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})
			//->resizeCanvas($print_w, $print_h)
			->save($upload_dir . $filenames['large']);

		// Resize and watermark photo for preview
		$img->reset()
			->backup()
			->resize(900, null, function ($constraint) { $constraint->aspectRatio(); })
			->fill($watermark)
			->save($upload_dir . $filenames['preview']);

		// Resize photo for thumbnail
		$img->reset()
			->resize(350, 350, function ($constraint) { $constraint->aspectRatio(); })
			->save($upload_dir . $filenames['thumbnail']);

		// Free up memory
		$img->destroy();

		return $filenames;
	}

    private function regenerateWatermark($photo, Request $request)
    {
        $upload_dir = public_path() . '/uploads/';

        $img = Image::make($upload_dir . $photo->large_file);

        $oldFile = $photo->preview_file;

        $photo->preview_file = Uuid::generate(4) . '_P.' . pathinfo($photo->large_file, PATHINFO_EXTENSION);

        $watermark = $this->readWatermark($request);

        // Resize and watermark photo for preview
        $img->backup()
            ->resize(900, null, function ($constraint) { $constraint->aspectRatio(); })
            ->fill($watermark)
            ->save($upload_dir . $photo->preview_file);

        // Free up memory
        $img->destroy();

        @unlink($upload_dir . $oldFile);

        return $photo;
    }

    private function readWatermark(Request $request)
    {
        $watermarkType = $request->input('watermark_type');

        switch ($watermarkType) {
            case 1:
                $watermarkName = 'Dark-dark.png';
                break;
            case 2:
                $watermarkName = 'Dark-light.png';
                break;
            case 3:
                $watermarkName = 'Dark-warm.png';
                break;
            case 4:
                $watermarkName = 'Lite-Dark.png';
                break;
            case 5:
                $watermarkName = 'LITE-med.png';
                break;
            case 6:
                $watermarkName = 'Lite-Light.png';
                break;
            case 7:
                $watermarkName = 'Medium-hi-contrast.png';
                break;
            case 8:
                $watermarkName = 'Medium-light-fill.png';
                break;
            case 9:
                $watermarkName = 'Medium-middle.png';
                break;
            case 10:
                $watermarkName = 'Extra-Lite-DW.png';
                break;
            default:
                $watermarkName = 'Medium-middle.png';
                break;
        }

        //$watermark = Image::make(public_path() . '/img/watermark.png');
        //return Image::make(public_path() . '/img/watermarks/' . $watermarkName);
				return Image::make(public_path() . '/img/watermarks/' . $watermarkType);
    }

}
