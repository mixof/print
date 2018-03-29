@extends('layouts.admin')

@section('title') Add Image Type @stop

@section('content')
    <div class="page-header">
        <h1>Add Image Type</h1>
    </div>

    {{ Form::open(['route' => 'admin.imageType.store', 'role' => 'form']) }}
        @include('admin.imageType.form-fields')
    {{ Form::close() }}

@stop