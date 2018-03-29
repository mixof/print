@extends('layouts.admin')

@section('title') Edit User @stop

@section('content')
	<div class="page-header">
		<h1>
			Edit User
		</h1>
	</div>

	{{ Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'PUT', 'role' => 'form']) }}
		@include('admin.user.form-fields')
	{{ Form::close() }}

	{{ Form::open(array('route' => array('admin.user.destroy', $user->id))) }}
	<div class="pull-right">
		{{csrf_field()}}
		{{method_field('DELETE')}}

		<button type="submit" id="delete-order{{ $user->id }}" class="btn btn-danger">Delete</button>
	</div>
	{{ Form::close() }}
@stop