<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function isNotOwnProfile($id)
	{
	  return ($id != Auth::user()->id);
	}

	protected function redirectOnNotOwnProfile()
	{
	  return Redirect::to('/')->withErrors(array(
		'message' => 'You are trying to edit somebody else\'s information'
	  ));
	}
}
