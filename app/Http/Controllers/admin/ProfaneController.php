<?php

namespace Admin;

use BaseController, Profane, Input, View, Redirect;

class ProfaneController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$words = Profane::orderBy('name', 'ASC')->paginate(15);

		return View::make('admin.profane.index', compact('words'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$record = Profane::find($id);

		if (!$record) {
			$record = new Profane(Input::all());
		}

		return View::make('admin.profane.edit', compact('record'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$record = Profane::find($id);

		if ($record) {
			if ($record->update(Input::all('name'))) {
				return Redirect::route('admin.profane.index')->with('success', 'Profane word updated.');
			}

		} else {
			$record = new Profane(Input::all('name'));

			if ($record->save()) {
				return Redirect::route('admin.profane.index')->with('success', 'Profane word saved.');
			}

			return Redirect::back()->withErrors($record->getErrors())->withInput();
		}


		return Redirect::back()->withErrors($record->getErrors())->withInput();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$record = new Profane(Input::all('name'));

		if ($record->save()) {
			return Redirect::route('admin.profane.index')->with('success', 'Profane word saved.');
		}

		return Redirect::back()->withErrors($record->getErrors())->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Profane::destroy($id);

		return Redirect::route('admin.profane.index')->with('success', 'Profane word deleted.');
	}
}
