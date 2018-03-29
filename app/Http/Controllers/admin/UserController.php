<?php

namespace Admin;

use BaseController, App\Models\User, Illuminate\Http\Request, View, Redirect;

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::with('artist')->orderBy('updated_at', 'DESC')->paginate(15);

		return View::make('admin.user.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.user.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = new User($request->all());

		$user->admin = $request->input('admin');

		if ($user->save()) {
			return Redirect::route('admin.user.index')->with('success', 'User saved.');
		}

		return Redirect::back()->withErrors($user->getErrors())->withInput();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		return View::make('admin.user.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$user->email = $request->input('email');
		$user->admin = $request->input('admin');

		// Only change the password if one was entered
		if ($request->input('password')) {
			$user->password = $request->input('password');
		}

		if ($user->save()) {
			return Redirect::route('admin.user.index')->with('success', 'User updated.');
		}

		return Redirect::back()->withErrors($user->getErrors())->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::route('admin.user.index')->with('success', 'User deleted.');
	}


}
