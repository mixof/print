@extends('layouts.master')

@section('title') Artist Account: {{ $artist->first_name }} {{ $artist->middle_name }} {{ $artist->last_name }} @stop

@section('content')
	
	<div class="page-header">
		<h1>
			Artist Account: {{ $artist->first_name }} {{ $artist->middle_name }} {{ $artist->last_name }}
		</h1>
	</div>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="artist-tabs-nav">
		<li class=" @if ($tab == "profile") active @endif"><a href="#profile" role="tab" data-toggle="tab">My Profile</a></li>
		<li class=" @if ($tab == "photos") active @endif"><a href="#photos" role="tab" data-toggle="tab">My Photos</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content" id="artist-tabs">
		<div class="tab-pane @if ($tab == "profile") active @endif" id="profile">
			@include('artist.tabs.profile')
		</div>
		<div class="tab-pane @if ($tab == "photos") active @endif" id="photos">
			@include('artist.tabs.photos')
		</div>
	</div>

@stop