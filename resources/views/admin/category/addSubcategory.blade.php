@extends('layouts.admin')

@section('title') Add Subcategory @stop

@section('content')
    <div class="page-header">
        <h1>Add Subcategory to {{{ $category->name }}}</h1>
    </div>

    {{ Form::model($category, ['route' => ['admin.category.saveSub', $category->id], 'method' => 'PUT', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::label('add_subcategory', 'Categories:') }}
        {{ Form::select('subcategories', $categoryList, null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Save Subcategory', ['class' => 'btn btn-primary']) }}

@stop