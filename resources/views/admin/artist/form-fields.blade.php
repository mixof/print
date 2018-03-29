<div class="form-group col-sm-12">
	{{ Form::label('file', 'Photo') }}
	@if (!empty($artist) && $artist->photo)
	<p class="form-control-static">
		<img src="{{ $artist->photo_url }}" width="100">
	</p>
	@endif
	{{ Form::file('file') }}
</div>
<div class="form-group col-sm-6">
	{{ Form::label('display_name', 'Display Name') }}
	{{ Form::text('display_name', null, ['placeholder' => 'Display Name', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-6">
	{{ Form::label('user_id', 'Linked to User') }}
	{{ Form::select('user_id', $userList, null, ['placeholder' => 'No User Linked', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-5">
	{{ Form::label('first_name', 'First Name') }}
	{{ Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-2">
	{{ Form::label('middle_name', 'Middle Name') }}
	{{ Form::text('middle_name', null, ['placeholder' => 'Middle Name', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-5">
	{{ Form::label('last_name', 'Last Name') }}
	{{ Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-6">
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-6">
	{{ Form::label('paypal_email', 'PayPal Email') }}
	{{ Form::email('paypal_email', null, ['placeholder' => 'PayPal Email', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-12">
	{{ Form::label('phone', 'Phone') }}
	{{ Form::input('tel', 'phone', null, ['placeholder' => 'Phone', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-12">
	{{ Form::label('bio', 'Bio') }}
	{{ Form::textarea('bio', null, ['placeholder' => 'Bio', 'class' => 'form-control']) }}
</div>
<div class="form-group col-sm-12">
	{{ Form::label('deactive_account', 'Account Status') }}
	{{ Form::select('deactive_account', array('0'=>'Active','1'=>'Deactive'), null, ['class' => 'form-control']) }}
</div>
<div class="col-sm-12">
	{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
</div>