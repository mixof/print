@extends('layouts.admin')

@section('title') Add Category @stop

@section('content')
	<div class="page-header">
		<h1>
			Add Category
		</h1>
	</div>

	{{ Form::open(['route' => 'admin.category.store', 'role' => 'form']) }}
		@include('admin.category.form-fields')
	{{ Form::close() }}
@stop