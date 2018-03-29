@extends('layouts.master')

@section('title') Browse @stop

@section('content')
        <!-- BEGIN browse -->
<div id="browse">
    <span class="h2">browse</span>
    <a href="?min_price=0&amp;max_price=3">$1 - 3</a>
    <a href="?min_price=4&amp;max_price=6">$4 - 6</a>
    <a href="?min_price=7">$7+</a>
</div>
<!-- END End browse -->

<div class="row">
    <div class="col-sm-2">
        <ul class="nav nav-pills nav-stacked">
            <li style="cursor: pointer">
                <div id="digitalArtHeader">
                    <div class="left-arrow"></div>
                    <strong>Digital Art</strong>
                </div>
                <ul id="digitalCategories" class="nav nav-pills nav-stacked" style="display: none;">
                @foreach ($artCategories as $category)
                    <li class="{{ Route::input('slug') === $category->slug ? 'active' : '' }}"><a
                                href="{{ URL::route('photo.index.category', array(2, $category->slug)) }}">
                            {{{ $category->name }}}
                        </a>
                    @if($category->children->count())
                        @foreach($category->children as $subcategory)
                            <li style="padding-left: 10px;" class="{{ Route::input('slug') === $subcategory->slug ? 'active' : '' }}">
                                <a href="{{ URL::route('photo.index.category', array(2, $subcategory->slug)) }}">{{{ $subcategory->name }}}</a>
                            </li>
                        @endforeach
                    @endif
                    </li>
                @endforeach
                </ul>
            </li>
            <li style="cursor: pointer">
                <div id="photoHeader">
                    <div class="down-arrow"></div>
                    <strong>Photography</strong>
                </div>
                <ul id="photoCategories" class="nav nav-pills nav-stacked">
                @foreach ($photoCategories as $category)
                    <li class="{{ Route::input('slug') === $category->slug ? 'active' : '' }}">
                        <a href="{{ URL::route('photo.index.category', array(1, $category->slug)) }}">
                            {{{ $category->name }}}
                        </a>
                        @if($category->children->count())
                            @foreach($category->children as $subcategory)
                                <li style="padding-left: 10px;" class="{{ Route::input('slug') === $subcategory->slug ? 'active' : '' }}">
                                    <a href="{{ URL::route('photo.index.category', array(1, $subcategory->slug)) }}">{{{ $subcategory->name }}}</a>
                                </li>
                            @endforeach
                        @endif
                    </li>
                @endforeach
                </ul>
            </li>
        </ul>
    </div>

    <div class="col-sm-10">
        @include('gallery_browse')

        {{ $photos->links() }}
    </div>
</div>

@include('layouts.revive')
@stop