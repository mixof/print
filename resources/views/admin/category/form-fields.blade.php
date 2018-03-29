<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
</div>

<h2>Image Types</h2>
<div class="row">
    @foreach($imageTypes as $imageType)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="checkbox">
                <label>
                    {{ $imageType->name }}
                    <?php $checked = $selectedTypes->has($imageType->id) ? true : false; ?>
                    {{ Form::checkbox('imageTypes[]', $imageType->id, $checked) }}
                </label>
            </div>
        </div>
    @endforeach
</div>

@if($category->isParent())
    <div class="row">
        <div class="col-md-10 col-xs-12">
            <h2>Subcategories</h2>
        </div>
        <div class="col-md-2 col-xs-12">
            <a class="btn btn-primary pull-right" href="{{ URL::route('admin.category.addSub', $category->id) }}">+ Add Subcategory</a>
        </div>
        <div class="col-sm-offset-1 col-sm-10 col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($category->children as $subcategory)
                    <tr>
                        <td>
                            {{ $subcategory->name }}
                        </td>
                        <td>
                            <a class="btn btn-danger pull-right" href="{{URL::route('admin.category.removeSub', [$subcategory->id, $category->id]) }}">Delete Subcategory</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}