@extends('layouts.master')

@section('title') Home @stop

@section('content')
	<style>
		.glyphicon.glyphicon-search{
				display: none!important;
		}
	</style>
	<!-- BEGIN slideshow -->
	<div id="slideshow_container">
		<div id="slide1" class="slide">
			<div class="image col-sm-6 col-xs-12">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide1image.png') }}" />
			</div>
			<div class="text col-sm-6 col-xs-12">
				A simpler way to buy and sell prints.
			</div>
		</div>
		<div id="slide2" class="slide">
			<div class="image col-sm-6 col-xs-12">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide2image.jpg') }}" />
			</div>
			<div class="text col-sm-6 col-xs-12">
				Introducing a pay-and-print system where buyers print instantly, and artists retain control of their image files.
			</div>
		</div>
		<div id="slide3" class="slide">
			<div class="center">
             &nbsp;
			</div>
			<div class="left">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide3left.png') }}" />
				<div class="text">1. Turn on printer, load in your paper.</div>
			</div>
			<div class="right">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide3right.png') }}" />
				<div class="text">2. Submit payment through PayPal.</div>
			</div>
		</div>
		<div id="slide4" class="slide">
			<div class="left">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide4left.png') }}" />
				<div class="text">3. Copy your code, download the app.</div>
			</div>
			<div class="right">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide4newRight.png') }}" />
				<div class="text">
					4. Give the printing app permission to run.
				</div>
			</div>
		</div>
		<div id="slide5" class="slide">
			<div class="left">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide5left.png') }}" />
				<div class="text">5. Enter your code and click Print.</div>
			</div>
			<div class="right">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide5right.jpg') }}" />
				<div class="text">6. Your usual printer dialog box will open.</div>
			</div>
		</div>
		<div id="slide6" class="slide">
			<div class="image col-sm-5 col-xs-12">
				<img class="img-responsive" src="{{ URL::asset('img/slides/slide6image.png') }}" />
			</div>
			<div class="text col-sm-7 col-xs-12">
				Choose your settings for print quality, paper type, etc. If you see an option for "Borderless printing", select that. Then click Print!
			</div>
		</div>
	</div>
	<!-- END slideshow -->

	<div class="callouts row">
		<div class="col-sm-offset-1 col-sm-5 col-xs-6">
            <span style="display: block; float: right; ">
			<strong>BUY</strong>: Print photos out directly<span class="hidden-sm hidden-xs">, using your own printer and paper. Faster, greener, cheaper. </span>
			<a href="{{ URL::to('/information') }}#buy">Read&nbsp;More&nbsp;&raquo;</a>
            </span>
		</div>
		<div class="col-sm-5 col-xs-6">
			<strong>SELL</strong>: Artists, just sell your prints.<span class="hidden-sm hidden-xs"> Don't hand over your image files.</span>
			<a href="{{ URL::to('/information') }}#sell">Read&nbsp;More&nbsp;&raquo;</a>
		</div>
	</div>

	<div class="tagline lead text-center">You already have a printer. Why wait for the delivery guy?</div>

	<!-- BEGIN pricepoints -->
	<div id="pricepoints" style="display: none;">
		<a href="{{ URL::route('photo.index') }}?min_price=0&amp;max_price=3" class="selected">$1 - 3</a>
		<a href="{{ URL::route('photo.index') }}?min_price=4&amp;max_price=6">$4 - 6</a>
		<a href="{{ URL::route('photo.index') }}?min_price=7">$7+</a>
	</div>
	<!-- END pricepoints -->

	@include('gallery')

	@include('layouts.revive')
@stop
