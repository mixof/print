@extends('layouts.master')

@section('title') Photographer Signup @stop

@section('content')
	<div class="page-header">
		<h1>
			Photographer Signup
		</h1>
	</div>

	{{ Form::model($user, ['route' => ['user.signup', $invite->hash], 'role' => 'form']) }}
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
		</div>

		{{ Form::submit('Signup', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}
@stop