@extends('layouts.master')

@section('title') {{ $artist->display_name }} Prints @stop

@section('content')
<style>
	.twittericon{
		width: 25px;
		margin-left:10px;
		border-radius: 50%;
	}
</style>
	<div id="artist-portfolio" class="row">
		<div class="col-sm-3 artist-column">
			<h3 class="text-center">{{{ $artist->display_name }}}</h3>
			@if ($artist->photo)
				<div class="text-center public-profile-photo">
					<img src="{{ $artist->photo_url }}" />
				</div>
            @else 
               <div class="text-center public-profile-photo">
					<img src="{{ URL::asset('img/profile standin.png') }}" />
			   </div>     
			@endif
			<p>{!! nl2br($artist->bio) !!}</p>
			@if ($artist['tw_confirm'] == 1)
				@if (nl2br($artist->bio))
				<p class="text-center" style="margin-top:30px;">
					Follow me on<a href="http://twitter.com/share?url={{ Request::url() }}&text=8by10prints&hashtags=8by10prints" target="_blank"><img src="{{ URL::asset('img/social_icons/Twitter.svg') }}" alt="Twitter"  class="twittericon"/></a>
				</p>
				@else
				<p class="text-center" style="margin-top:55vh;">
					Follow me on<a href="http://twitter.com/share?url={{ Request::url() }}&text=8by10prints&hashtags=8by10prints" target="_blank"><img src="{{ URL::asset('img/social_icons/Twitter.svg') }}" alt="Twitter"  class="twittericon"/></a>
				</p>
				@endif
		@endif
		</div>

		<div class="col-sm-9 ">
			<h3>Works by {{{ $artist->display_name }}}</h3>

			@include('gallery_browse')

			{{ $photos->links() }}
		</div>
	</div>

@include('layouts.revive')
@stop