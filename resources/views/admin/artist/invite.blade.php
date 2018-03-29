@extends('layouts.admin')

@section('title') Invite @if($artist) {{ $artist->first_name  }} {{ $artist->last_name  }} Artist @else User  @endif @stop

@section('content')
	<div class="page-header">
		<h1>
			Invite @if($artist) {{ $artist->first_name  }} {{ $artist->last_name  }} Artist @else User  @endif
		</h1>
	</div>

	Copy following link.
	@if($artist)
		It allows to create one user account associated only with {{ $artist->email }} artist.
	@else
		It allows to create one user account and artist profile for anybody who get link.
	@endif

	<textarea class="form-control">{{ $link }}</textarea>
@stop