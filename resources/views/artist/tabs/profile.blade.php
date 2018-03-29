{{ Form::model($artist, ['route' => ['artist.update', $artist->id], 'method' => 'PUT', 'files' => true, 'role' => 'form', 'class' => 'autovalidate']) }}
<div class="row">
    <div class="form-group col-sm-11 text-right">
        <span class="required_mark">* Required</span>
    </div>

    <div class="form-group col-sm-2">
        {{ Form::label('display_name', 'Display Name:') }}<span class="required_mark">*</span>
        <br><span class="formhint">(Public.)</span>
    </div>

    <div class="form-group col-sm-8">
        {{ Form::text('display_name', null, ['placeholder' => 'Display Name', 'class' => 'form-control']) }}
        <span class="formhint">&nbsp;&nbsp;&nbsp;You can use your real name or a screen name. This will appear under the title of each image.</span>
    </div>
    <div class="clearfix"></div>

    <div class="form-group col-sm-1">
        {{ Form::label('first_name', 'First Name:') }}<span class="required_mark">*</span>
    </div>
    <div class="form-group col-sm-4">
    {{ Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control required']) }}
    </div>
    <div class="form-group col-sm-1">
        {{ Form::label('middle_name', 'M.I.') }}
    </div>
    <div class="form-group col-sm-1">
        {{ Form::text('middle_name', null, ['placeholder' => 'M.I.', 'class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-1">
        {{ Form::label('last_name', 'Last Name:') }}<span class="required_mark">*</span>
    </div>
    <div class="form-group col-sm-4">
        {{ Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control required']) }}
    </div>
    <div class="clearfix"></div>

    <div class="form-group col-sm-1">
        {{ Form::label('email', 'Email:') }}<span class="required_mark">*</span>
    </div>
    <div class="form-group col-sm-5">
        {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control required']) }}
        <span class="formhint">&nbsp;&nbsp;&nbsp;One that you check daily.</span>
    </div>
    <div class="form-group col-sm-1">
        {{ Form::label('phone', 'Phone:') }}
    </div>
    <div class="form-group col-sm-5">
        {{ Form::input('tel', 'phone', null, ['placeholder' => 'Phone', 'class' => 'form-control']) }}
    </div>
    <div class="clearfix"></div>

    <div class="form-group col-sm-1">
        {{ Form::label('paypal_email', 'PayPal Email:') }}<span class="required_mark">*</span>
    </div>
    <div class="form-group col-sm-5">
        {{ Form::email('paypal_email', null, ['placeholder' => 'PayPal Email', 'class' => 'form-control required']) }}
        <span class="formhint">&nbsp;&nbsp;&nbsp;May be the same as the one above.</span>
    </div>
    <div class="form-group col-sm-1">
        {{ Form::label('file', 'Add profile photo:') }}
    </div>
    <div class="form-group col-sm-5">
        @if (!empty($artist) && $artist->photo)
            <p class="form-control-static">
                <img src="{{ $artist->photo_url }}" width="100">
            </p>
            <p>
                <button type="button" class="btn btn-xs btn-danger"
                        onclick="location.href='{{ URL::route('artist.nophoto', $artist->id) }}?t=<?php echo time(); ?>'"
                        >remove photo</button>
            </p>
        @endif
        {{ Form::file('file') }}
    </div>
    <div class="clearfix"></div>


    <div class="form-group col-sm-12">
        {{ Form::label('bio', 'Bio:') }}<br>
        <span class="formhint">(Public.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Use this space to tell people the who, what, when, where of your
        work. If you have your own website feel free to link to it.</span>
        {{ Form::textarea('bio', null, ['placeholder' => 'Biography', 'class' => 'form-control']) }}
    </div>
    
    <div class="form-group col-sm-2">
        {{ Form::label('text', 'Display the Twitter:') }}
    </div>
    <div class="form-group col-sm-1">
      @if($artist['tw_confirm'] == 0)
        {{ Form::checkbox('tw_confirm', null, ['id' => 'check_twi','class' => 'form-control checkbox_section', 'style' => 'width: 15px;margin-top: -5px;box-shadow: none!important;margin-left: -30px;']) }}
      @else
        {{ Form::checkbox('tw_confirm', null, true, ['id' => 'check_twi','class' => 'form-control checkbox_section', 'style' => 'width: 15px;margin-top: -5px;box-shadow: none!important;margin-left: -30px;']) }}
      @endif
    </div>
    <div class="form-group col-sm-12 text-right">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    </div>
</div>
{{ Form::close() }}