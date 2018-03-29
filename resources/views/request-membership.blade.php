@extends('layouts.master')

@section('title') Artist Membership Request @stop

@section('content')
	<div class="page-header">
		<h1>
            Artist Membership Request
        </h1>
	</div>

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist" id="artist-tabs-nav">
		<li class="active"><a href="#profile" role="tab" data-toggle="tab">Use this form to...</a></li>

	</ul>

	<!-- Tab panes -->
	<div class="tab-content" id="artist-tabs">
		<div class="tab-pane active" id="profile">
			{{ Form::open(['route' => ['send'], 'files' => true, 'role' => 'form', 'class' => 'autovalidate']) }}
            <div class="row">

                <span class="required_mark pull-right">* Required</span>
                <div class="form-group col-sm-8">
                    Request a membership for selling your photos or digital art on Prinstantly.com.
                </div>

                <div class="form-group col-sm-8">
                    @if(Session::has('message'))
                        <h3>{{ Session::get('message') }}</h3>
                    @endif
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-1 col-sm-offset-1">
                    {{ Form::label('name', 'NAME') }}
                </div>
                <div class="form-group col-sm-4">
                  {{ Form::label('first_name', 'First:') }}<span class="required_mark">*</span>
                  {{ Form::text('first_name', null, ['class' => 'form-control required', 'style' => 'max-width:394px']) }}
                </div>
               
                <div class="form-group col-sm-4">
                    {{ Form::label('last_name', 'Last:') }}<span class="required_mark">*</span>
                    {{ Form::text('last_name', null, ['class' => 'form-control required', 'style' => 'max-width:394px']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-1 col-sm-offset-1">
                    {{ Form::label('where_you_live', 'WHERE YOU LIVE') }}
                </div>

                <div class="form-group col-sm-4">
                    {{ Form::label('country', 'Country:') }}
                    {{ Form::select('country', $countries, 218, ['class' => 'form-control required', 'id'=>'country_id', 'style' => 'max-width:381px'] ) }}
                </div>
                <div class="form-group col-sm-4">
                    {{ Form::label('state', 'State:') }}
                    {{ Form::select('state', $states, null, ['class' => 'form-control required', 'style' => 'max-width:398px'] ) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-2 col-sm-offset-1">
                    {{ Form::label('city', 'City/Town:') }}
                </div>
                <div class="form-group col-sm-4">
                    {{ Form::text('city', null, ['class' => 'form-control']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-2 col-sm-offset-1">
                    {{ Form::label('email', 'EMAIL ADDRESS:') }}<span class="required_mark">*</span>
                </div>
                <div class="form-group col-sm-5 ">
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-2 col-sm-offset-1">
                    {{ Form::label('email_confirmation', 'Confirm Email Address:') }}<span class="required_mark">*</span>
                </div>
                <div class="form-group col-sm-5">
                    {{ Form::text('email_confirmation', null, ['class' => 'form-control']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-10 col-sm-offset-1">
                    YOUR IMAGES must exist as digital files that you can email me, and they must be of adequate size.
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-4 col-sm-offset-1">
                    {{ Form::label('email', 'Are your images in PNG or JPG format?') }}
                </div>
        
                <div class="form-group col-sm-1 col-sm-offset-1">
                    {{ Form::label('yes1', 'YES') }} 
                    {{ Form::radio('photo_type', 'yes', 'checked', ['class' => 'form-control required']) }}
                </div>

                <div class="form-group col-sm-1 col-sm-offset-1">
                    {{ Form::label('no1', 'NO') }}
                    {{ Form::radio('photo_type', 'no', null, ['class' => 'form-control required']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-10 col-sm-offset-1">
                    Are your photos large enough so that they have either a minimum LENGTH of 3000 pixels OR a minimum WIDTH of 2400 pixels?
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-sm-1 col-sm-offset-1">
                    {{ Form::label('yes2', 'YES') }}
                    {{ Form::radio('photo_size', 'yes', 'checked', ['class' => 'form-control required']) }}
                </div>
                <div class="form-group col-sm-1">
                    {{ Form::label('no2', 'NO') }}
                    {{ Form::radio('photo_size', 'no', null, ['class' => 'form-control required']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-10  col-sm-offset-1">
                    IS THERE A PAGE/pages on the Internet where I can evaluate your photos or digital art? This could be anything from a Facebook album to a Flickr account (please list all).
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-sm-10 col-sm-offset-1">
                    {{ Form::textarea('urls', null, ['placeholder' => 'Please provide accurate URL\'s that lead right to your images.', 'class' => 'form-control', 'rows'=>4]) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-10  col-sm-offset-1">
                    IF YOUR IMAGES are not viewable online, please contact us about using a free file-sharing service such as Dropbox or Google Drive for artwork evaluation.
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-10   col-sm-offset-1">
                    DO YOU HAVE A PAYPAL ACCOUNT?
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-1 col-sm-offset-1">
                    {{ Form::label('yes3', 'YES') }}
                    {{ Form::radio('paypal', 'yes', 'checked', ['class' => 'form-control required']) }}
                </div>
                <div class="form-group col-sm-1">
                    {{ Form::label('no3', 'NO') }}
                    {{ Form::radio('paypal', 'no', null, ['class' => 'form-control required']) }}
                </div>
                <div class="form-group col-sm-4">
                    If No, would you be willing to
                    get one (they're free)?
                </div>
                <div class="form-group col-sm-1   col-sm-offset-1">
                    {{ Form::label('yes4', 'YES') }}
                    {{ Form::radio('get_paypal', 'yes', 'checked', ['class' => 'form-control required']) }}
                </div>
                <div class="form-group col-sm-1">
                    {{ Form::label('no4', 'NO') }}
                    {{ Form::radio('get_paypal', 'no', null, ['class' => 'form-control required']) }}
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-10  col-sm-offset-1">
                    {{ Form::textarea('comments', null, ['placeholder' => 'Add comments or question.', 'class' => 'form-control', 'rows'=>3]) }}
                </div>
                <div class="clearfix"></div>


                <div class="form-group col-sm-12 text-center">
                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                </div>
                <div class="form-group col-sm-6 col-sm-offset-3">
                    Thank you for requesting an artist membership on Prinstantly.com. Your<br />
                    information will be reviewed in a timely manner and decision notification sent as<br />
                    quickly as possible.
                </div>
                <div class="clearfix"></div>

            </div>
            {{ Form::close() }}
		</div>
	</div>
<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script>
    $(document).ready(function()
    {
        $("#country_id").change(function(e) {
            var country_id = $(this).val();
            var url = "/states/"+country_id; // the script where you handle the form input.
            $.ajax({
                     type: "GET",
                      url: url,
                      data: "",
                   success: function(data) {
                        $("#state").html(data);
                      },
                      error: function(){}
                    });
          });
    });
</script>
@stop