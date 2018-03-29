@extends('layouts.master')

@section('title') @if ( !empty($photo->meta_name) ) {{{$photo->meta_name}}} @else {{{ $photo->title }}} @endif @stop
@section('metaKeywords') @if ( !empty($photo->meta_keywords) ) {{{$photo->meta_keywords}}} @else {{{ str_limit($photo->tags, 200) }}} @endif @stop
@section('metaDescription') @if ( !empty($photo->meta_description) ) {{{$photo->meta_description}}} @else {{{ str_limit($photo->description,300) }}} @endif @stop

@section('content')
	<div id="photo-details" class="row">
		<div class="col-xs-1 mobilearr_hidden"><a class="prev-link" href="{{$links['prev']}}"><span class="glyphicon glyphicon-chevron-left"></span></a></div>

		<div class="col-sm-7 text-center">
			
			<div class="magnify">
				<div class="large"></div>
				<img src="{{ $photo->preview_file_url }}" class="preview small">
			</div>
				
			
		</div>
		<div class="col-sm-1 mobilearr_show"><a class="prev-link" href="{{$links['prev']}}"><span class="glyphicon glyphicon-chevron-left"></span></a></div>
		<div class="col-sm-3 col-sm-offset-0 col-xs-offset-2 col-xs-8">
            <div class="visible-xs">
                &nbsp;
            </div>
			<div class="panel panel-default" data-offset-top="60">
				<div class="panel-body">
					<h2>{{{ $photo->title }}}</h2>

					<p>
						<strong>Artist:</strong>
						@if ( !empty($photo->artist->display_name) )<a href="{{ URL::route('artist.show', $photo->artist->slug) }}">{{{ $photo->artist->display_name }}}</a>@endif
					</p>
					
					<p><strong>Price:</strong> ${{ $photo->price }}</p>
					
					<a href="{{ URL::route('photo.buy', $photo->slug) }}" class="btn btn-primary btn-lg btn-block">Print</a>
				</div>

                @if( strlen($photo->description) > 0)
                <div class="panel-body">
                    <p id="shortDesc"><strong>Description:</strong> {{{ str_limit($photo->description,300) }}}
                     @if( strlen($photo->description) > 300)
                        <a href="javascript:;" id="readMore" >Read More &rsaquo;</a>
                     @endif
                    </p>
                    <p id="fullDesc"><strong>Description:</strong> {{{ $photo->description }}}</p>

                </div>
                @endif
<style type="text/css">
#share-buttons img {
    width: 35px;
    padding: 5px;
    border: 0;
    box-shadow: 0;
    display: inline;
}
a.prev-link, a.next-link {
    font-size: 45px;
    color: #c0c0c05c;
}
a.prev-link:hover, a.next-link:hover{
    color: #f9e4cd;
}
	
.magnify {width: 100%; margin: 50px auto; position: relative; cursor: none}

/*Lets create the magnifying glass*/
.large {
	width: 200px; height: 200px;
	position: absolute;
	/*border-radius: 100%;*/
	
	/*Multiple box shadows to achieve the glass effect*/
	box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 
	0 0 7px 7px rgba(0, 0, 0, 0.25), 
	inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
	
	/*hide the glass by default*/
	display: none;
}

/*To solve overlap bug at the edges during magnification*/
.small { display: block; }
	
.panel.panel-default	{
	width: 90%;
}
.glyphicon{
		top: 200px!important;
}
.magnify{
		margin:0px!important;
}	
</style>
                 <div class="panel-body" id="share-buttons" style="padding-top: 0;">

                    <a href="http://www.facebook.com/sharer.php?u={{ Request::url() }}" target="_blank"><img src="{{ URL::asset('img/social_icons/Facebook.svg') }}" alt="Facebook" /></a>

                    <a href="http://twitter.com/share?url={{ Request::url() }}&text=8by10prints&hashtags=8by10prints" target="_blank"><img src="{{ URL::asset('img/social_icons/Twitter.svg') }}" alt="Twitter" /></a>

                    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><img src="{{ URL::asset('img/social_icons/Pinterest.svg') }}" alt="Pinterest" /></a>
                 </div>


			</div>

		</div>
		<div class="col-sm-1 mobile_next"><a class="next-link" href="{{$links['next']}}"><span class="glyphicon glyphicon-chevron-right"></span></a></div>

	</div>

@stop

@section('footer')
<style>
#fullDesc{
    display: none;
}
@media (max-width: 700px){
	.mobilearr_hidden{
		display: none;
	}	
	.mobilearr_show{
		display: block!important;
	}
	.mobile_next .glyphicon{
		top: 135px!important;
	}
	.col-sm-3.col-sm-offset-0{
		left: 12px;
	}
}
@media (min-width: 700px){
	.mobilearr_hidden{
		display: block!important;
	}	
	.mobilearr_show{
		display: none;
	}
	.mobile_next .glyphicon{
		top: 200px!important;
	}
}
	
</style>
<script type="text/javascript">
$(document).ready(function () {
	// Make the fixed sidebar keep it's width when scrolling
	function affixWidth() {
		var $elm= $('div[data-spy="affix"]');
		$elm.width($elm.parent().width());
	}

	affixWidth();
	$(window).resize(affixWidth);

    $('#readMore').click(function()
    {
        $('#shortDesc').hide();
        $('#fullDesc').show();
    });
// Magnify tool
	var native_width = 0;
	var native_height = 0;
  $(".large").css("background","url('" + $(".small").attr("src") + "') no-repeat");

	//Now the mousemove function
	$(".magnify").mousemove(function(e){
		//When the user hovers on the image, the script will first calculate
		//the native dimensions if they don't exist. Only after the native dimensions
		//are available, the script will show the zoomed version.
		if(!native_width && !native_height)
		{
			//This will create a new image object with the same image as that in .small
			//We cannot directly get the dimensions from .small because of the 
			//width specified to 200px in the html. To get the actual dimensions we have
			//created this image object.
			var image_object = new Image();
			image_object.src = $(".small").attr("src");
			
			//This code is wrapped in the .load function which is important.
			//width and height of the object would return 0 if accessed before 
			//the image gets loaded.
			native_width = image_object.width;
			native_height = image_object.height;
		}
		else
		{
			//x/y coordinates of the mouse
			//This is the position of .magnify with respect to the document.
			var magnify_offset = $(this).offset();
			//We will deduct the positions of .magnify from the mouse positions with
			//respect to the document to get the mouse positions with respect to the 
			//container(.magnify)
			var mx = e.pageX - magnify_offset.left;
			var my = e.pageY - magnify_offset.top;
			
			//Finally the code to fade out the glass if the mouse is outside the container
			if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
			{
				$(".large").fadeIn(100);
			}
			else
			{
				$(".large").fadeOut(100);
			}
			if($(".large").is(":visible"))
			{
				//The background position of .large will be changed according to the position
				//of the mouse over the .small image. So we will get the ratio of the pixel
				//under the mouse pointer with respect to the image and use that to position the 
				//large image inside the magnifying glass
				var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
				var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
				var bgp = rx + "px " + ry + "px";
				
				//Time to move the magnifying glass with the mouse
				var px = mx - $(".large").width()/2;
				var py = my - $(".large").height()/2;
				//Now the glass moves with the mouse
				//The logic is to deduct half of the glass's width and height from the 
				//mouse coordinates to place it with its center at the mouse coordinates
				
				//If you hover on the image now, you should see the magnifying glass in action
				$(".large").css({left: px, top: py, backgroundPosition: bgp});
			}
		}
	})


});
</script>
@stop