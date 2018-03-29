@extends('layouts.admin')

@section('title') Categories @stop

@section('content')
	<div class="page-header">
		<h1>
			Categories
			<a class="btn btn-primary pull-right" href="{{ URL::route('admin.category.create') }}" role="button">+ Add Category</a>
		</h1>
	</div>

	@if ($categoryList->count())
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Photos</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($categoryList as $category)
				<tr>
					<td class="primary"><a href="{{ URL::route('admin.category.edit', $category->id) }}">{{{ $category->name }}}</a></td>
					<td>{{ $counts[$category->id] }}</td>
				</tr>
				@if($category->children->count())
					@foreach($category->children as $subcategory)
						<tr>
							<td style="padding-left:25px;">
								----> <a href="{{ URL::route('admin.category.edit', $subcategory->id) }}">{{ $subcategory->name }}</a>
							</td>
							<td>
								{{ $subcategory->photos->count() }}
							</td>
						</tr>
					@endforeach
				@endif
			@endforeach
			</tbody>
		</table>

		{{ $categoryList->links() }}
	@else
		<p>Sorry, there are no categories to display.</p>
	@endif
@stop