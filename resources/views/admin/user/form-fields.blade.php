<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
</div>
<div class="checkbox">
	<label>
		{{ Form::checkbox('admin', '1') }}
		Administrator
	</label>
</div>

{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}