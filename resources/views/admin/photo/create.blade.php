@extends('layouts.admin')

@section('title') Add Photo @stop

@section('content')
	<div class="page-header">
		<h1>
			Add Photo
		</h1>
	</div>

	{{ Form::open(['route' => 'admin.photo.store', 'files' => true, 'role' => 'form']) }}
		{{csrf_field()}}
		@include('admin.photo.form-fields')
	{{ Form::close() }}
@stop