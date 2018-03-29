@extends('layouts.admin')

@section('title') Add User @stop

@section('content')
	<div class="page-header">
		<h1>
			Add User
		</h1>
	</div>

	{{ Form::open(['route' => 'admin.user.store', 'role' => 'form']) }}
		@include('admin.user.form-fields')
	{{ Form::close() }}
@stop