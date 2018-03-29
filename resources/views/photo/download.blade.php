@extends('layouts.master')

@section('title') Download "{{{ $photo->title }}}" @stop

@section('content')

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="page-header">
                <h1>Thank you for your purchase!</h1>
            </div>

            <p>Your payment has gone through successfully and you can now print your image. To do so please <a href="{{ asset('app/prinstantly.jar') }}" style="text-decoration: underline;">download</a>
                our Java application and enter the following code when prompted:</p>

            <div class="well h1 text-center">{{ $order[0]->hash }}</div>

            <p>This authorization code must be used within 3 days (72 hours) of purchase. This allows us to pay our artists in a timely manner. No refunds will be given for expired codes.</p>
            <p> </p>   
            <p> </p>
            <p> </p>
        </div>
    </div>

@include('layouts.revive')

@stop