<?php

use App\Models\Invite;
use App\Models\Artist;
use App\Models\User;

class UserController extends BaseController {

  /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	  if ($this->isNotOwnProfile($id)) {
		return $this->redirectOnNotOwnProfile();
	  }

	  $user = User::findOrFail($id);

	  return View::make('user.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	  if ($this->isNotOwnProfile($id)) {
		return $this->redirectOnNotOwnProfile();
	  }

	  $user = User::findOrFail($id);

		$user->email = Input::get('email');

		// Only change the password if one was entered
		if (Input::get('password')) {
			$user->password = Input::get('password');
		}

		if ($user->save()) {
			return Redirect::back()->with('success', 'Account settings saved.');
		}

		return Redirect::back()->withErrors($user->getErrors())->withInput();
	}

	/**
	 * Create form
	 *
	 * @param  string  $invite
	 * @return Response
	 */
	public function signup($invite)
	{
		// Get invite ticket:
		$invite = Invite::where('hash', '=', $invite)->first();
		if (!$invite) {
            return Redirect::to('/')->withErrors(array(
                'message' => 'Invalid invitation ticket'
            ));
		}
		// Get associated artist:
		$artist = Artist::where('id', '=', $invite->artist_id)->first();

		// Check if user account already registered for artist
		if ($artist && $artist->user_id) {
			// Ticket is bad, remove all tickets for this artist:
			Invite::where('artist_id', '=', $artist->id)->delete();
            return Redirect::to('/')->withErrors(array(
                'message' => 'User account is already assigned. Invitation ticket is expired'
            ));
		}

		$user = new User();
		if (Input::get('email')) {
			$user->email = Input::get('email');
		}
		if (Input::get('password')) {
			$user->password = Input::get('password');
		}

		if (Request::isMethod('post')) {
			$userEmail = User::where('email', '=', $user->email)->first();
			if ($userEmail) {
				return Redirect::back()->withErrors(array(
					'message' => 'This email address is already registered. Choose another one.'
				))->withInput();
			}

			if ($user->save()) {
				if ($invite->artist_id) {
					$artist->user_id = $user->id;
					$artist->save();

					Invite::where('artist_id', '=', $invite->artist_id)->delete();
				} else {
					$artist = new Artist();
					$artist->fill(array(
						'user_id' => $user->id,
						'display_name' => 'Display Name',
						'first_name' => 'First Name',
						'last_name' => 'Last Name',
						'email' => $user->email,
						'paypal_email' => $user->email,
						'bio' => 'Bio',
						'phone' => 'Phone',
					));
					$artist->save();
					$invite->delete();
				}

				if (Auth::attempt(
					['email' => Input::get('email'), 'password' => Input::get('password')],
					false,
					true
				)) {
					return Redirect::to('artist/' . $artist->id . '/edit').with(
						'success', 'Your account has been created'
					);
				}

				return Redirect::to('/').with(
					'success', 'Your account has been created. Please login now to continue signup');
			}
			return Redirect::back()->withErrors($user->getErrors())->withInput();
		}

		return View::make('user.signup', compact('invite', 'user'));
	}

    public function states($country_id)
    {
        $states = State::where('country_id', $country_id)->orderBy('name')->lists('name', 'id');

        foreach($states as $id=>$state)
            echo '<option value="'.$id.'">'.$state.'</option>';


        return ;
    }

    public function test() {
    	
    }
}
