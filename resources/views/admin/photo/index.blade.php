@extends('layouts.admin')

@section('title') Images @stop

@section('content')
    <div class="page-header">
        <h1>
            Images
            <a class="btn btn-primary pull-right" href="{{ URL::route('admin.photo.create') }}" role="button">+ Add
                Image</a>
        </h1>
    </div>

    <table class="table table-hover" id="imagesTable" data-page-length="25">
        <thead>
        <tr>
            <th>
                Title
            </th>
            <th>
                Author
            </th>
            <th>
                Image Type
            </th>
            <th>
                Category
            </th>
            <th>
                Price
            </th>
            <th>Orders</th>
            <th>
                Hide Photo
            </th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($photoList as $photo)
            <tr>
                <td class="primary"><a href="{{ URL::route('admin.photo.edit', $photo->id) }}">{{ $photo->title }}</a>
                </td>
                <td>@if ( !empty($photo->display_name) )<a
                            href="{{ URL::route('admin.artist.edit', $photo->artist_id) }}">{{ $photo->display_name }}</a>
                    @endif</td>
                <td>{{{ $photo->image_type_name }}}</td>
                <td>{!! $photo->category_name !!}</td>
                <td>${{{ $photo->price }}}</td>
                <td>{{ App\Models\Order::with('photo')->where('paid', '=', 1)->where('photo_id', '=', $photo->id)->count() }}</td>
                <td>@if ( $photo->hide_photo == 1 ) <span style="color:#F03">Hidden</span> @else <span
                            style="color:#063">Visible</span>  @endif</td>
                <td>
                    <a class="btn btn-mini btn-success" href="{{ URL::route('admin.photo.edit', $photo->id) }}">EDIT</a>
                    <a class="btn btn-mini btn-primary"
                       href="{{ URL::route('admin.photo.hide', $photo->id) }}">@if ( $photo->hide_photo == 1 )
                            SHOW @else HIDE @endif</a>
                    <button class="btn btn-danger btn-mini delete-btn" data-form="form-{{$photo->id}}"
                            title="{{{ $photo->title }}}">DELETE
                    </button>

                    <form action="{{ URL::route('admin.photo.destroy', $photo->id) }}" class="delete-form"
                          id="form-{{$photo->id}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!--Confirmation Delete Modal-->
    <div class="modal fade delete-confirmation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Do you want to Delete <strong class="title"></strong> on the lists?</p>
                    <p class="text-warning">
                        <small> This photo will permanently remove on the record</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary delete-true">Delete Photo</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/images.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$('table').DataTable();
		})
	</script>
@stop