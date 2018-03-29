@extends('layouts.admin')

@section('title') Edit Image Type @stop

@section('content')
    <div class="page-header">
        <h1>
            Edit Image Type
        </h1>
    </div>

    {{ Form::model($imageType, ['route' => ['admin.imageType.update', $imageType->id], 'method' => 'PUT', 'role' => 'form']) }}
    @include('admin.imageType.form-fields')
    {{ Form::close() }}

    {{ Form::open(array('route' => array('admin.imageType.destroy', $imageType->id))) }}
    <div class="pull-right">
        {{csrf_field()}}
        {{method_field('DELETE')}}

        <button type="submit" id="delete-order{{ $imageType->id }}" class="btn btn-danger">Delete</button>
    </div>
    {{ Form::close() }}

@stop