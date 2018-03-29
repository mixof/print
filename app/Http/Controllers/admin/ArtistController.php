<?php

namespace Admin;

use BaseController, App\Models\Artist, App\Models\User, Illuminate\Http\Request, App\Models\Invite, URL, View, Redirect, Uuid, Image, Illuminate\Support\Facades\Input;

class ArtistController extends BaseController {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$artistList = Artist::with('photos')->get();
//        with('photos')->orderBy('updated_at', 'DESC');

		return View::make('admin.artist.index', compact('artistList'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$userList = User::all()->pluck('email', 'id');

		return View::make('admin.artist.create', compact('userList'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$artist = new Artist($request->all());

		if ($request->hasFile('file')) {
			$artist->photo = $this->handleUpload();
		}

		if ($artist->save()) {
			return Redirect::route('admin.artist.index')->with('success', 'Artist saved.');
		}

		return Redirect::back()->withErrors($artist->getErrors())->withInput();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$artist = Artist::findOrFail($id);
		$userList = User::all()->pluck('email', 'id');

		return View::make('admin.artist.edit', compact('artist', 'userList'));
	}

	/**
	 * Show invitation one-time link allowing artist to create account.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function invite($id)
	{
		$artist = Artist::find($id);

		$hash = sha1($id . time());

		$invite = new Invite(array(
			'artist_id' => $id,
			'hash'      => $hash,
 		));
		$invite->save();

		$link = URL::route('user.signup', array('invite' => $hash));

		return View::make('admin.artist.invite', compact('artist', 'link'));
	}
	
	public function deactivate($id)
	{
		$artist = Artist::find($id);
        $artist->deactive_account = $artist->deactive_account == 0 ? 1 : 0;
		if ($artist->save()) {
			return Redirect::route('admin.artist.index')->with('success', 'Artist Updated.');
		}
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$artist = Artist::findOrFail($id);
		$artist->fill($request->all());
		if (Input::hasFile('file')) {
			$artist->photo = $this->handleUpload();
		}

		if ($artist->save()) {
			return Redirect::route('admin.artist.index')->with('success', 'Artist updated.');
		}

		return Redirect::back()->withErrors($artist->getErrors())->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Artist::destroy($id);
		return Redirect::route('admin.artist.index')->with('success', 'Artist deleted.');
	}


	private function handleUpload() {
		$upload_dir = public_path() . '/uploads/artists/';
		$file = Input::file('file');
		$filename = Uuid::generate(4) . '.' . $file->getClientOriginalExtension();

		// Resize photo
		Image::make($file->getRealPath())
			->fit(300, 300, function ($constraint) {
			    $constraint->aspectRatio(); })
			->save($upload_dir . $filename)
			->destroy();

		return $filename;
	}
}
