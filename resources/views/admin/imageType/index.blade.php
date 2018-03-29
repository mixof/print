@extends('layouts.admin')

@section('title') Image Types @stop

@section('content')
    <div class="page-header">
        <h1>
            Image Types
            <a class="btn btn-primary pull-right" href="{{ URL::route('admin.imageType.create') }}" role="button">+ Add Image Type</a>
        </h1>
    </div>

    @if ($imageTypes->count())
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Categories</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($imageTypes as $imageType)
                <tr>
                    <td class="primary">
                        <a href="{{ URL::route('admin.imageType.edit', $imageType->id) }}">{{{ $imageType->name }}}</a>
                    </td>
                    <td>{{ $imageType->categories->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $imageTypes->links() }}
    @else
        <p>Sorry, there are no image types to display</p>
    @endif
@stop