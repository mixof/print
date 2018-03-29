@extends('layouts.admin')

@section('title') Artists @stop

@section('content')
        
	<div class="page-header">
		<h1>
			Artists
			<a class="btn btn-success pull-right" href="{{ URL::route('admin.artist.create') }}" role="button">+ Add Artist</a>
            <a class="btn btn-primary pull-right" href="{{ URL::route('admin.artist.invite', 0) }}" role="button" style="margin-right: 10px;">+ Invite User</a>
		</h1>
	</div>

	@if ($artistList->count())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Photos</th>
					<th>Balance</th>
					<th>User Account</th>
                    <th>Status</th>
                    <th>Action </th>
				</tr>
			</thead>
			<tbody>
			@foreach ($artistList as $artist)
				<tr>
					<td class="primary"><a href="{{ URL::route('admin.artist.edit', $artist->id) }}">{{ $artist->display_name }}</a></td>
					<td><a href="mailto:{{ $artist->email }}">{{ $artist->email }}</a></td>
					<td>{{ $artist->phone }}</td>
					<td>{{ $artist->photos->count() }}</td>
					<td>${{ $artist->balance }}</td>
					<td>
						@if ($artist->user_id)
							<a href="{{ URL::route('admin.user.edit', $artist->user_id) }}">#{{ $artist->user_id }}</a>
						@else
							<a href="{{ URL::route('admin.artist.invite', $artist->id) }}">+Invite</a>
						@endif
					</td>
                    <td>
                    	@if ($artist->deactive_account == 1 ) <span style="color:#F03">Inactive</span> @else <span style="color:#063">Active</span> @endif
                    </td>
                                        <td>
                                            <a class="btn btn-sm btn-success" href="{{ URL::route('admin.artist.edit', $artist->id) }}">EDIT</a>
                                             <a class="btn btn-sm btn-primary" href="{{ URL::route('admin.artist.deactivate', $artist->id) }}">@if ($artist->deactive_account == 1 ) ACTIVATE @else DEACTIVATE @endif</a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-form="form-{{$artist->id}}" title="{{ $artist->display_name }}">DELETE</button>
                                            <form action="{{ URL::route('admin.artist.destroy', $artist->id) }}" class="delete-form" id="form-{{$artist->id}}" method="post">
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
                        <p class="text-warning"><small> This artist will permanently remove on the record</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary delete-true">Delete Artist</button>
                    </div>
                </div>
            </div>
        </div>
	@else
		<p>Sorry, there are no artists to display.</p>
	@endif
@stop
