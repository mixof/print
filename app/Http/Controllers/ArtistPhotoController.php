<?php

use App\Models\Artist;
use App\Models\Photo;

class ArtistPhotoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int  $artist_id
	 * @return Response
	 */
	public function index($artist_id)
	{
	  $artist = Artist::findOrFail($artist_id);
      
	  if ($this->isNotOwnProfile($artist->user_id)) {
		return $this->redirectOnNotOwnProfile();
	  }

	  $photos = Photo::with('artist', 'category', 'orders')
			->where('artist_id', '=', $artist_id)
			->orderBy('updated_at', 'DESC')
			->paginate(15);

		return View::make('artist.photo.index', compact('photos'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $artist_id
	 * @param  int  $photo_id
	 * @return Response
	 */
	public function edit($artist_id, $photo_id)
	{

	  $photo = Photo::findOrFail($photo_id);
	  $artist = Artist::findOrFail($photo->artist_id);

	  if ($this->isNotOwnProfile($artist->user_id)) {
		return $this->redirectOnNotOwnProfile();
	  }

	  return View::make('artist.photo.edit', compact('photo'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $artist_id
	 * @param  int  $photo_id
	 * @return Response
	 */
	public function update($artist_id, $photo_id)
	{
		$photo = Photo::findOrFail($photo_id);

	  $artist = Artist::findOrFail($photo->artist_id);

	  if ($this->isNotOwnProfile($artist->user_id)) {
		return $this->redirectOnNotOwnProfile();
	  }

	  if ($photo->update(Input::all())) {
			return Redirect::back()->with('success', 'Photo saved.');
		}

		return Redirect::back()->withErrors($photo->getErrors())->withInput();
	}


	/**
	 * Update field of photo.
	 *
	 * @return Response
	 */
	public function update_field()
	{
		$fieldName = Input::get('name');
		$photoID = intval(Input::get('pk'));
		$value = Input::get('value');
		$error = '';

		header('Content-type:application/json');
		$photo = Photo::find($photoID);

	  $artist = Artist::findOrFail($photo->artist_id);

	  if ($this->isNotOwnProfile($artist->user_id)) {
		return $this->redirectOnNotOwnProfile();
	  }

	  $allowedFields = array('title', 'description', 'price','hide_photo','delete','sort_order');

	  	if (!in_array($fieldName, $allowedFields)) {
			$error = 'Invalid field';
		}

        $result = new StdClass;
		if($fieldName == 'delete') {
            $photo->delete();
            $result->status = 'success';
        }else{
	    	if (!$photo->update(array($fieldName => $value))) {
              $errors = $photo->getErrors();
              list($error) = $errors->get($fieldName);
            }

            if ($error) {
                $result->status = 'error';
                $result->msg = $error;
            } else {
                $result->status = 'success';
            }
        }
		echo json_encode($result);
		exit;
	}

}
