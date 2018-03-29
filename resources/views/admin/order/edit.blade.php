@extends('layouts.admin')

@section('title') Edit Order @stop

@section('content')
    <div class="page-header">
        <h1>
            Edit Order
        </h1>
    </div>

    {{ Form::model($order, ['route' => ['admin.order.update', $order->id], 'method' => 'PUT', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::label('date', 'Date') }}
        <p class="form-control-static">
            {{ $order->created_at }}
        </p>
    </div>
    <div class="form-group">
        {{ Form::label('photo', 'Photo') }}
        <p class="form-control-static">
            <a href="{{ URL::route('admin.photo.edit', $order->photo->id) }}">{{{ $order->photo->title }}}</a>
        </p>
    </div>
    <div class="form-group">
        {{ Form::label('amount', 'Amount') }}
        <p class="form-control-static">
            ${{ $order->amount }}
        </p>
    </div>
    <div class="form-group">
        {{ Form::label('paid', 'Paid') }}
        <p class="form-control-static">
            {{ $order->paid ? 'Yes' : 'No' }}
        </p>
    </div>
    <div class="form-group">
        {{ Form::label('printed', 'Printed') }}
        <div>
            <label class="radio-inline">
                {{ Form::radio('printed', '1') }} Yes
            </label>
            <label class="radio-inline">
                {{ Form::radio('printed', '0') }} No
            </label>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('hash', 'Hash') }}
        <p class="form-control-static">
            {{ $order->hash }}
        </p>
    </div>

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}

    {{ Form::open(array('route' => array('admin.order.destroy', $order->id))) }}
    <div class="pull-right">
        {{csrf_field()}}
        {{method_field('DELETE')}}

        <button type="submit" id="delete-order{{ $order->id }}" class="btn btn-danger">Delete</button>
    </div>
    {{ Form::close() }}

@stop