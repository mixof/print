@extends('layouts.master')

@section('title') My Images @stop

@section('content')
	<div class="page-header">
		<h1>
			My Images
			<!--<a class="btn btn-primary pull-right" href="" role="button">+ Add Photo</a>-->
		</h1>
	</div>

	@if ($photos->count())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Title</th>
					<th>Category</th>
					<th>Price</th>
					<th>Prints Sold</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($photos as $photo)
				<tr>
					<td class="primary"><a href="{{ URL::route('artist.photo.edit', [$photo->artist->id, $photo->id]) }}">{{{ $photo->title }}}</a></td>
					<td>{{{ $photo->category->name }}}</td>
					<td>${{{ $photo->price }}}</td>
					<td>{{ Order::with('photo')->where('paid', '=', 1)->where('photo_id', '=', $photo->id)->count() }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>

		{{ $photos->links() }}
	@else
		<p>Sorry, there are no photos to display.</p>
	@endif
@stop