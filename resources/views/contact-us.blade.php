@extends('layouts.master')

@section('title') Contact Us @stop

@section('content')
	<div class="page-header">
		<h1>Contact Us</h1>
	</div>

	<p>For questions, problems, issues, or comments, please contact us at <a href="mailto:{{ encodeEmail('hey@prinstantly.com') }}"><img src="/img/email-button.png" height="20" /></a></p>
	
	<div class="row">
		<div class="col-xs-12" style="min-height: 50px;">&nbsp;</div>
	</div>

@include('layouts.revive')
@stop