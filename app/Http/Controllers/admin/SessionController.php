<?php

namespace Admin;

use BaseController, Auth, View, Redirect, Input;

class SessionController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.session.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Auth::attempt(
				['email' => Input::get('email'), 'password' => Input::get('password'), 'admin' => true], 
				Input::get('remember')
			))
		{
			return Redirect::intended('admin');
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

		return Redirect::route('admin.login');
	}


}
