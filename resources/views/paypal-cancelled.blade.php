@extends('layouts.master')

@section('title') Terms and Privacy @stop

@section('content')
    <div class="row informationWrap">
        <div class="col-xs-10">
            <div class="page-header">
                <h1>Paypal Payment Cancelled</h1>
            </div>
			<a href="{{route('photo.buy',$slug)}}">Try Again</a>
        </div>
    </div>

@include('layouts.revive')

@stop