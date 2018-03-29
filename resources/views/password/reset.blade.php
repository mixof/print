@extends('layouts.master')

@section('title') Reset Password @stop

@section('content')

    <div class="row informationWrap">
        <div class="page-header">
            <h2>Reset Password</h2>
        </div>

        @if (Session::has('error'))
            {{ trans(Session::get('reason')) }}
        @endif

        {{ Form::open(array('route' => array('password.update', $token))) }}

        <p>
            <input class="input-lg" type="email" name="email" placeholder="Email Address"/></p>

        <p><input class="input-lg" type="password" name="password" placeholder="Password"/></p>

        <p><input class="input-lg" type="password" name="password_confirmation" placeholder="Confirm PW"/></p>

        {{ Form::hidden('token', $token) }}

        <p>
            <button class="btn btn-lg btn-primary">Reset Password</button>
        </p>
        {{ Form::close() }}
    </div>
@stop