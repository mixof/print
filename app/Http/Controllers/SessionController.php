<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SessionController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('session.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Auth::attempt(
				['email' => Input::get('email'), 'password' => Input::get('password')], 
				Input::get('remember')
			))
		{
			//return Redirect::intended('/');
			$appUserId = Auth::user()->id;
			$appUser = User::find($appUserId);
			if ( $appUser->artist ) {
				return Redirect::to('artist/' . $appUser->artist->id . '/edit?tab=photos/');
			} else {
				return Redirect::back()->withErrors(['Invalid type of account'])->withInput();
			}
		}

		return Redirect::back()->withErrors(['Invalid email address or password.'])->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

		return Redirect::route('login');
	}


}
