<!DOCTYPE html>
<html lang="en">
	<head>
		<title>@yield('title') | Prinstantly Admin</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>

        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>


	</head>
	<body>
		@if (Auth::check() && Auth::user()->admin)
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ URL::to('/admin') }}">Prinstantly Admin</a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li {{ Request::is('admin/order*') ? 'class="active"' : '' }}><a href="{{ URL::route('admin.order.index') }}">Orders</a></li>
						<li {{ Request::is('admin/photo*') ? 'class="active"' : '' }}><a href="{{ URL::route('admin.photo.index') }}">Images</a></li>
						<li {{ Request::is('admin/artist*') ? 'class="active"' : '' }}><a href="{{ URL::route('admin.artist.index') }}">Artists</a></li>
						<li {{ Request::is('admin/imageType*') ? 'class="active"' : '' }}><a href="{{ URL::route('admin.imageType.index') }}">Image Types</a></li>
						<li {{ Request::is('admin/category*') ? 'class="active"' : '' }}><a href="{{ URL::route('admin.category.index') }}">Categories</a></li>
						<li {{ Request::is('admin/user*') ? 'class="active"' : '' }}><a href="{{ URL::route('admin.user.index') }}">Users</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{ Auth::user()->email }}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ URL::route('admin.user.edit', Auth::user()->id) }}">Settings</a></li>
								<li><a href="{{ URL::to('admin/logout') }}">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div><!-- /.navbar -->

		<div class="container">
			@if ($errors->has())
				@foreach ($errors->all() as $error)
					<div class='bg-danger alert'>{{ $error }}</div>
				@endforeach
			@endif

			@if (Session::get('success'))
				<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
			@endif
                        
			@yield('content')
		</div><!-- /.container -->

		
		
		<script>
		  $('.delete-btn').click(function(event){
			 event.preventDefault();
			 var formid = $(this).attr('data-form');
			 var title = $(this).attr('title');
			 $('.modal-body .title').text(title);
			 $(".delete-confirmation").modal('show');
			 $('.delete-true').click(function(){
				 $('#'+formid).submit();
				 $(".delete-confirmation").modal('hide');
			 });
		  }); 
        </script>
		@else
			<div class="container">
				<div class="row">
					You need to login...
				</div>
			</div>
		@endif
		
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	</body>
</html>