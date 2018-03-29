@extends('layouts.admin')

@section('title') Orders @stop

@section('content')
	<div class="page-header">
		<h1 class="pull-left">
			Orders
		</h1>
        <?php $paidcount = App\Models\Order::where('paid_artist', '=', 0)->get();?>


        <a href="" class="payall btn btn-primary pull-right pay" <?php echo $paidcount->count() ? '' : 'disabled="disabled"'; ?> ><span class="glyphicon glyphicon-refresh spinning" style="display:none;"></span> Pay all artists</a>

        <div class="clearfix"></div>
	</div>

	@if ($orders->count())
		<table id="orderTable" class="table table-hover" data-page-length="25">
			<thead>
				<tr>
					<th>Date</th>
					<th>Photo</th>
					<th>Amount</th>
					<th>Printed</th>
                    <th>Artist</th>
                    <th>Artist Payment</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($orders as $order)
				<tr>
					<td><a href="{{ URL::route('admin.order.edit', $order->id) }}">{{ $order->created_at->toDateTimeString() }}</a></td>
					@if ($order->photo->trashed())
						<td>{{ $order->photo->title }}</td>
					@else
						<td><a href="{{ URL::route('admin.photo.edit', $order->photo->id) }}">{{ $order->photo->title }}</a></td>
					@endif
					<td>${{ $order->amount }}</td>
					<td>{{ $order->printed ? 'Yes' : 'No' }}</td>
                    <td>
                        @if ($order->photo->artist)
                        <a href="{{ URL::route('admin.artist.edit', $order->photo->artist->id) }}">{{ $order->photo->artist->display_name }}</a></td>
                        @else
                            Removed
                        @endif
                    <td>
                        @if ( $order->paid_artist == 0 )
                            @if ($order->photo->artist)
                            <a class="btn btn-default pay" name="pay" data-id="{{$order->id}}"><span class="glyphicon glyphicon-refresh spinning" style="display:none;"></span>Pay Artist</a>
                            @else
                                Not Paid
                            @endif
                        @else
                            <span style="color:#090">PAID</span> </span>
                        @endif
                    </td>
				</tr>
			@endforeach
			</tbody>
		</table>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/u/bs/dt-1.10.12,fc-3.2.2,fh-3.1.2,r-2.1.0/datatables.min.js"></script>
        <script src="{{ asset('js/admin/orders.js') }}"></script>
	@else
		<p>Sorry, there are no orders to display.</p>
	@endif
@stop