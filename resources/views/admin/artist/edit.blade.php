@extends('layouts.admin')

@section('title') Edit Artist @stop

@section('content')
	<div class="page-header">
		<h1>
			Edit Artist
		</h1>
	</div>

	{{ Form::model($artist, ['route' => ['admin.artist.update', $artist->id], 'method' => 'PUT', 'files' => true, 'role' => 'form']) }}
		@include('admin.artist.form-fields')
	{{ Form::close() }}

	{{ Form::open(array('route' => array('admin.artist.destroy', $artist->id))) }}
	<div class="pull-right">
		{{csrf_field()}}
		{{method_field('DELETE')}}

		<button type="submit" id="delete-order{{ $artist->id }}" class="btn btn-danger">Delete</button>
	</div>
	{{ Form::close() }}
@stop