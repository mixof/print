<div class="form-group">
	{{ Form::label('file', 'File') }}
	{{ Form::file('file') }}

    <br/>
    Apply Watermark on Preview after upload:
<!--     {{ Form::select('watermark_type', array(
        '1'=>'Dark-dark (639x406)',
        '2'=>'Dark-light (639x406)',
        '3'=>'Dark-warm (639x406)',
        '4'=>'Lite-Dark (640x407)',
        '5'=>'Lite-Medium (642x407)',
        '6'=>'Lite-Light (640x407)',
        '7'=>'Medium Hi-Contrast (640x406)',
        '8'=>'Medium Light-fill (640x406)',
        '9'=>'Medium-middle (640x406)'
        ),
        9, ['class' => 'form-control']) }} -->
		<select class="form-control" name="watermark_type">
			<?php foreach ($filenamelist as $key => $filename) { ?>
			<option value="<?php echo $filename ?>"><?php echo $filename ?></option>
			<?php } ?>
		</select>
    @if ( isset($photo) )
    {{ Form::checkbox('watermark_regenerate', '1', null, array('id'=>'watermark_regenerate')) }} <label for="watermark_regenerate">Re-generate preview with watermark</label>
    @endif
</div>
<div class="form-group">
	{{ Form::label('orientation', 'Orientation') }}
	<div class="radio">
		<label class="radio-inline">
			{{ Form::radio('orientation', 'portrait', true) }} Portrait
		</label>
		<label class="radio-inline">
			{{ Form::radio('orientation', 'landscape') }} Landscape
		</label>
	</div>
</div>
<div class="form-group">
	{{ Form::label('title', 'Title') }}
	{{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('description', 'Description') }}
	{{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'rows' => 3]) }}
</div>
<div class="form-group">
	{{ Form::label('tags', 'Tags') }}
	{{ Form::textarea('tags', null, ['placeholder' => 'Comma separated tag words', 'class' => 'form-control', 'rows' => 3]) }}
</div>
<div class="form-group">
	{{ Form::label('artist_id', 'Artist') }}
	{{ Form::select('artist_id', $artistList, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('image_type_id', 'Image Type') }}
	{{ Form::select('image_type_id', $imageTypeList, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('category_id', 'Category') }}
	{{ Form::select('category_id[]', $categoryList, null, ['class' => 'form-control', 'multiple' => 'multiple']) }}
</div>
<div class="form-group">
	{{ Form::label('price', 'Price') }}
	<div class="input-group">
		<div class="input-group-addon">$</div>
		{{ Form::text('price', null, ['placeholder' => '0.00', 'class' => 'form-control']) }}
	</div>
</div>
<div class="form-group col-sm-6 col-xs-12">
	{{ Form::label('hide_photo', 'Hide Photo') }}
	{{ Form::select('hide_photo', array('0'=>'No','1'=>'Yes'), null, ['class' => 'form-control']) }}
</div>
<div class="form-group col-sm-6 col-xs-12">
	{{ Form::label('exclude_homepage', 'Exclude from Homepage?') }}
	{{ Form::select('exclude_homepage', array('0'=>'No','1'=>'Yes'), null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('meta_name', 'SEO Meta Name') }}
    {{ Form::text('meta_name', null, ['placeholder' => 'Photo Title is used if not set', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('meta_keywords', 'SEO Meta Keywords') }}
    {{ Form::text('meta_keywords', null, ['placeholder' => 'Photo Tags is used if not set', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('meta_description', 'SEO Meta Description') }}
    {{ Form::text('meta_description', null, ['placeholder' => 'Photo Description is used if not set', 'class' => 'form-control']) }}
</div>

{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}