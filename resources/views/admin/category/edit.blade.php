@extends('layouts.admin')

@section('title') Edit Category @stop

@section('content')
	<div class="page-header">
		<h1>
			Edit Category
		</h1>
	</div>

	{{ Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PUT', 'role' => 'form']) }}
		@include('admin.category.form-fields')
	{{ Form::close() }}

	{{ Form::open(array('route' => array('admin.category.destroy', $category->id))) }}
	<div class="pull-right">
		{{csrf_field()}}
		{{method_field('DELETE')}}

		<button type="submit" id="delete-order{{ $category->id }}" class="btn btn-danger">Delete</button>
	</div>
	{{ Form::close() }}
@stop