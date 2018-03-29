@extends('layouts.master')

@section('title') Send Password Reset @stop

@section('content')

    <div class="row informationWrap">
        <div class="col-xs-10">
            <div class="page-header">
                <h2>Send Password Reset</h2>
            </div>
            {{ Form::open(array('route' => 'password.remindPost')) }}
            <input class="input-lg" type="email" name="email" placeholder="Email Address" />
            <button class="btn btn-primary btn-lg" type="submit">Send Password Reset Link</button>
            {{ Form::close() }}

        </div>
    </div>
@stop