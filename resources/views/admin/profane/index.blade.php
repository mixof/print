@extends('layouts.admin')

@section('title') Profane Words @stop

@section('content')
    <a class="btn btn-primary pull-right" href="{{ URL::route('admin.profane.edit') }}" role="button">+ Add Profane Word</a>
    <div class="page-header">
        <h1>
            Profane Words
        </h1>
        Titles of photos with profane words are rejected.
    </div>

    @if ($words->count())
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Word</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($words as $word)
                <tr>
                    <td><a href="{{ URL::route('admin.profane.edit', $word->id) }}">{{ $word->name }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $words->links() }}
    @else
        <p>Sorry, there are no words to display.</p>
    @endif
@stop