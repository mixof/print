@if ($photos->count())
	<style>
		.glyphicon.glyphicon-search{
			display: none!important;	
		}
	</style>
	<div class="row galleryRow">
	@foreach ($photos as $photo)
       @if ( $photo->artist )
		<div class="col-sm-2">
			<a href="{{ URL::route('photo.show', $photo->slug) }}" class="thumbnail" rel="{{ $photo->thumbnail_file_url }}">
				<img src="{{ $photo->thumbnail_file_url }}" alt=" @if ( !empty($photo->meta_description) ) {{$photo->meta_description}} @else {{ str_limit($photo->description,300) }} @endif " />
				<div class="caption">
                    <h4 class="title">{{ $photo->title }}</h4>
					@if ( !empty($photo->artist->display_name) ) <p class="artist">{{ $photo->artist->display_name }}</p> @endif
				</div>
			</a>
		</div>
        @endif
	@endforeach
	</div>
@endif