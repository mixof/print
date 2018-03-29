<?php

use App\Models\State;

class RequestMembershipController extends BaseController {

    public function request_membership()
    {
        $countries = Country::orderBy('name')->lists('name', 'id');
        $states = State::where('country_id', '218')->orderBy('name')->lists('name', 'id');

        return View::make('request-membership', compact('countries', 'states'));
    }

    public function send()
    {
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|confirmed'
        ];
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }

        $country = Country::findOrFail(Input::get('country'))->toArray()['name'];
        $state = State::findOrFail(Input::get('state'))->toArray()['name'];

        $data = Input::all();
        $data['country'] = $country;
        $data['state'] = $state;
        $data['images'] = '';

        if (Input::hasFile('file1'))
            $data['images'] .= '<tr><td colspan="2"><img src="'.URL::asset('uploads/membership').'/'.$this->handleUpload(Input::file('file1')).'"></td></tr>';
        if (Input::hasFile('file2'))
            $data['images'] .= '<tr><td colspan="2"><img src="'.URL::asset('uploads/membership').'/'.$this->handleUpload(Input::file('file2')).'"></td></tr>';
        if (Input::hasFile('file3'))
            $data['images'] .= '<tr><td colspan="2"><img src="'.URL::asset('uploads/membership').'/'.$this->handleUpload(Input::file('file3')).'"></td></tr>';
        if (Input::hasFile('file4'))
            $data['images'] .= '<tr><td colspan="2"><img src="'.URL::asset('uploads/membership').'/'.$this->handleUpload(Input::file('file4')).'"></td></tr>';
        if (Input::hasFile('file5'))
            $data['images'] .= '<tr><td colspan="2"><img src="'.URL::asset('uploads/membership').'/'.$this->handleUpload(Input::file('file5')).'"></td></tr>';

        Mail::send('emails.membership', $data, function ($message)
        {
            $message
		        ->to('dave@8by10prints.com')
		        ->from('support@8by10prints.com', 'Support')
                ->subject('Request a Membership - 8by10prints');
        });

        return Redirect::route('request-membership')
                       ->with('message', 'Your Photographer Membership Request has been sent.');
    }

    private function handleUpload($file)
    {
        $upload_dir = public_path() . '/uploads/membership/';

        $filename = Uuid::generate(4) . '.' . $file->getClientOriginalExtension();

        // Resize photo
        Image::make($file->getRealPath())
            //->resize(300, 300, function ($constraint) { $constraint->aspectRatio(); })
            ->fit(300, 300)
            ->save($upload_dir . $filename)
            ->destroy();

        return $filename;
    }
}
