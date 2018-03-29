@if ( !empty($photos_group) )
        @foreach ($photos_group as $photos)
	<div class="row galleryRow">
	   @foreach ( $photos as $photo )
        {{--@if ( $photo->artist )--}}
		<div class="col-sm-2">
			<a href="{{ URL::route('photo.show', $photo->slug) }}" class="thumbnail" rel="{{ $photo->thumbnail_file_url }}">
				<img src="{{ $photo->thumbnail_file_url }}" alt="{{{ $photo->meta_description }}}" />
				<div class="caption">
					<h4 class="title">{{{ $photo->title }}}</h4>
					@if ( !empty($photo->artist->display_name) ) <p class="artist">{{ $photo->artist->display_name }}</p> @endif
				</div>
			</a>
		</div>
	    {{--@endif--}}
	   @endforeach
	</div>
        @endforeach
@endif