@extends('layouts.master')

@section('title') Please Log In @stop

@section('content')
	<div id="artist-login" class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Artist Log In</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(['route' => 'session.store', 'role' => 'form']) }}
					{{ csrf_field() }}
					<fieldset>
						<div class="form-group">
							{{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
						</div>
						<div class="form-group">
							{{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
						</div>
						<div class="checkbox">
							<label>
								{{ Form::checkbox('remember', '1') }} Remember Me
							</label>
						</div>
						{{ Form::submit('Log In', ['class' => 'btn btn-lg btn-block btn-primary']) }}
						{{--<div style="text-align: center; padding: 5px 0;">--}}
							{{--<a href="{{ URL::route('password.remind') }}">Forgot Password?</a>--}}
                        {{--</div>--}}
						
					</fieldset>
					{{ Form::close() }}
				</div>
			</div>
			<div class="text-center">(No account necessary to buy prints.)</div>
		</div>
	</div>
@stop