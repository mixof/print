<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['placeholder' => 'Image Type Name', 'class' => 'form-control']) }}
</div>

<h2>Categories</h2>
<div class="row">
    @foreach($categoryList as $category)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="checkbox">
                <label>{{ $category->name }}
                     <?php $checked = $selectedCategories->has($category->id) ? true : false; ?>
                    {{ Form::checkbox('categories[]', $category->id, $checked) }}
                </label>
            </div>
        </div>
    @endforeach
</div>

{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
