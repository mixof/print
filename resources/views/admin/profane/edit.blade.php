@extends('layouts.admin')

@section('title') Edit Profane Word @stop

@section('content')
    <div class="page-header">
        <h1>
            Edit Profane Word
        </h1>
    </div>

    {{ Form::model($record, ['route' => ['admin.profane.update', $record->id], 'role' => 'form']) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
    </div>

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}

    {{ Form::delete(URL::route('admin.profane.destroy', $record->id), 'Delete', ['class' => 'pull-right', 'style' => 'margin-top: -34px;'], ['class' => 'btn btn-danger']) }}
@stop