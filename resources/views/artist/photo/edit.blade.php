@extends('layouts.master')

@section('title') Edit Photo @stop

@section('content')
	<div class="page-header">
		<h1>
			Edit Photo
		</h1>
	</div>

	{{ Form::model($photo, ['route' => ['artist.photo.update', $photo->artist->id, $photo->id], 'method' => 'PUT', 'role' => 'form']) }}
		<div class="form-group">
			{{ Form::label('title', 'Title') }}
			<div class="row">
				<div class="col-sm-5 col-md-4 col-lg-3">
					{{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
				</div>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			<div class="row">
				<div class="col-md-8 col-lg-6">
					{{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'rows' => 3]) }}
				</div>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('price', 'Price') }}
			<div class="row">
				<div class="col-sm-4 col-md-3 col-lg-2">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						{{ Form::text('price', null, ['placeholder' => '0.00', 'class' => 'form-control']) }}
					</div>
				</div>
			</div>
		</div>

		{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}
@stop