@extends('layouts.master')

@section('title') Account Settings @stop

@section('content')
	<div class="page-header">
		<h1>
			Account Settings
		</h1>
	</div>

	{{ Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'role' => 'form']) }}
		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			<div class="row">
				<div class="col-sm-6 col-md-5 col-lg-4">
					{{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
				</div>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('password', 'Password') }}
			<div class="row">
				<div class="col-sm-6 col-md-5 col-lg-4">
					{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
				</div>
			</div>
			<span class="help-block">Leave password field blank to keep current password.</span>
		</div>

		{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}
@stop