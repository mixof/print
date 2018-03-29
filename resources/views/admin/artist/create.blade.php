@extends('layouts.admin')

@section('title') Add Artist @stop

@section('content')
	<div class="page-header">
		<h1>
			Add Artist
		</h1>
	</div>

	<div class="row">
	{{ Form::open(['route' => 'admin.artist.store', 'files' => true, 'role' => 'form']) }}
		@include('admin.artist.form-fields')
	{{ Form::close() }}
	</div>
@stop