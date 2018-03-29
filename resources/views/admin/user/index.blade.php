@extends('layouts.admin')

@section('title') Users @stop

@section('content')
	<div class="page-header">
		<h1>
			Users
			<a class="btn btn-primary pull-right" href="{{ URL::route('admin.user.create') }}" role="button">+ Add User</a>
		</h1>
	</div>

	@if ($users->count())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Email</th>
					<th>Artist</th>
					<th>Admin</th>
                                        <th width="28%" align="center">Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
				<tr>
					<td class="primary"><a href="{{ URL::route('admin.user.edit', $user->id) }}">{{{ $user->email }}}</a></td>
					<td>
						@if ($user->artist)
							<a href="{{ URL::route('admin.artist.edit', $user->artist->id) }}">{{{ $user->artist->display_name }}}</a>
						@endif
					</td>
					<td>{{ $user->admin ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a class="btn btn-mini btn-success" href="{{ URL::route('admin.user.edit', $user->id) }}">EDIT USER</a>
                                            @if ($user->artist)
                                            <a class="btn btn-mini btn-primary" href="{{ URL::route('admin.artist.edit', $user->artist->id) }}">EDIT ARTIST</a>
                                            @endif
                                            <button class="btn btn-danger btn-mini delete-btn" data-form="form-{{{$user->id}}}" title="{{{ $user->display_name }}}">DELETE</button>
                                            <form action="{{ URL::route('admin.user.destroy', $user->id) }}" class="delete-form" id="form-{{$user->id}}" method="post">
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
                        <p>Do you want to Delete this user on the lists?</p>
                        <p class="text-warning"><small> This user will permanently remove on the record</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary delete-true">Delete User</button>
                    </div>
                </div>
            </div>
        </div>
		{{ $users->links() }}
	@else
		<p>Sorry, there are no users to display.</p>
	@endif
@stop