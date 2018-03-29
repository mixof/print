@extends('layouts.admin')

@section('title') Edit Photo @stop

@section('content')
    <div class="page-header">
        <h1>
            Edit Photo
        </h1>
    </div>

    {{ Form::model($photo, ['route' => ['admin.photo.update', $photo->id], 'method' => 'PUT', 'files' => true, 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::label('current_files', 'Current Files') }}
        <p class="form-control-static">
            <a href="{{ $photo->large_file_url }}">Large</a> |
            <a href="{{ $photo->preview_file_url }}">Preview</a> |
            <a href="{{ $photo->thumbnail_file_url }}">Thumbnail</a>
        </p>
    </div>

    @include('admin.photo.form-fields')
    {{ Form::close() }}

    {{ Form::open(array('route' => array('admin.photo.destroy', $photo->id))) }}
    <div class="pull-right">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button class="btn btn-danger" type="submit">Delete Photo</button>
    </div>
    {{ Form::close() }}
@stop