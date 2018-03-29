<?php

use App\Models\Artist;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

class ArtistController extends BaseController {

	/**
	 * Show the specified resource.
	 *
	 * @param  str  $slug
	 * @return Response
	 */
	public function show($slug)
	{
        $artist = Artist::where('slug', '=', $slug)->firstOrFail();
				$photos = Photo::where('artist_id', '=', $artist->id)->where('hide_photo',0)->orderBy('sort_order','ASC')->paginate(30);

        $artist->bio = $this->createWebLinks(strip_tags($artist->bio));

        if ($artist->bio == "Bio") {
            $artist->bio = '';
        }

		return View::make('artist.show', compact('artist', 'photos'));
	}

    /**
     * Find and make clickable links in text.
     *
     * @param str $text
     * @return string
     */
    private function createWebLinks($text)
    {
        $content = preg_replace('#(^|\s)([a-z]+://([^\s\w/<]?[\w/])*)#is', '\\1<a href="\\2" target="_blank">\\2</a>', $text);
        $content = preg_replace('#(^|\s)((www|ftp|\w+)\.([^\s\w/<]?[\w/])+)#is', '\\1<a href="http://\\2" target="_blank">\\2</a>', $content);
        $content = preg_replace('#(^|\s)(([a-z0-9._%+-]+)@(([.-]?[a-z0-9])*))#is', '\\1<a href="mailto:\\2">\\2</a>', $content);

        return $content;
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$artist = Artist::find($id);
		
		if (!$artist || $this->isNotOwnProfile($artist->user_id)) {
		  return $this->redirectOnNotOwnProfile();
		}

	  $photos = Photo::with('artist', 'orders')
			->where('artist_id', '=', $id)
			->orderBy('sort_order', 'ASC')
			->paginate(15);

		$tab = Input::get('tab', 'profile');

		return View::make('artist.edit', compact('artist', 'photos', 'tab'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$artist = Artist::findOrFail($id);
	  if ($this->isNotOwnProfile($artist->user_id)) {
		return $this->redirectOnNotOwnProfile();
	  }
		$tw_confirm = 0;
		if(Input::has('tw_confirm')){
			$tw_confirm = 1;
		}
	  $artist->fill(Input::all());
		$artist->tw_confirm = $tw_confirm;
		if (Input::hasFile('file')) {
			$artist->photo = $this->handleUpload();
		}
		
		$artist->slug = null;
		
		if ($artist->save()) {
			return Redirect::back()->with('success', 'Profile saved.');
		}

		return Redirect::back()->withErrors($artist->getErrors())->withInput();
	}

    /**
     * Remove existing profile picture.
     *
     * @param  int  $id
     * @return Response
     */
    public function nophoto($id)
    {
        $artist = Artist::findOrFail($id);

        if ($this->isNotOwnProfile($artist->user_id)) {
            return $this->redirectOnNotOwnProfile();
        }

        File::delete(public_path() . '/uploads/artists/' . $artist->photo);

        Artist::removePhoto($id);

        return Redirect::back()->with('success', 'Profile saved.');
    }


    private function handleUpload() {
		$upload_dir = public_path() . '/uploads/artists/';
		$file = Input::file('file');
		$filename = Uuid::generate(4) . '.' . $file->getClientOriginalExtension();

		// Resize photo
		Image::make($file->getRealPath())
			->resize(300, 300, function ($constraint) {
			    $constraint->aspectRatio(); })
			->save($upload_dir . $filename)
			->destroy();

		return $filename;
	}
}
