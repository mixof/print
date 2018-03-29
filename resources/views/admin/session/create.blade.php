@extends('layouts.master')

@section('title') Please Log In as Admin @stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Log In</h3>
					</div>
					<div class="panel-body">
						{{ Form::open(['route' => 'admin.session.store', 'role' => 'form']) }}
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
						</fieldset>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop