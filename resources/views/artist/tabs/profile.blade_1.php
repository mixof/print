{{ Form::model($artist, ['route' => ['artist.update', $artist->id], 'method' => 'PUT', 'files' => true, 'role' => 'form', 'class' => 'autovalidate']) }}
<div class="row">
    <div class="form-group col-sm-2">
        {{ Form::label('display_name', 'Display Name:') }}<span class="required_mark">*</span>
    </div>

    <div class="form-group col-sm-8">
        {{ Form::text('display_name', null, ['placeholder' => 'Display Name', 'class' => 'form-control']) }}
        <span class="formhint">Public. You can use your real name or a screen name. This will appear under the title of each photo.</span>
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
        <span class="formhint">One that you check daily.</span>
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
        <span class="formhint">May be the same as the one above.</span>
    </div>
    <div class="form-group col-sm-1">
        {{ Form::label('file', 'Add profile photo:') }}
    </div>
    <div class="form-group col-sm-5">
        @if (!empty($artist) && $artist->photo)
            <p class="form-control-static">
                <img src="{{ $artist->photo_url }}" width="100">
            </p>
        @endif
        {{ Form::file('file') }}
    </div>
    <div class="clearfix"></div>


    <div class="form-group col-sm-12">
        {{ Form::label('bio', 'Bio:') }}
        <span class="formhint formhint-bio">Public. Use this space to tell people the who, what, when, where of your
        photography. If you have your own website feel free to link to it.</span>
        {{ Form::textarea('bio', null, ['placeholder' => 'Biography', 'class' => 'form-control']) }}
    </div>

    <div class="form-group col-sm-6 text-left">
        <span class="required_mark">* - Required</span>
    </div>
    <div class="form-group col-sm-6 text-right">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    </div>
</div>
{{ Form::close() }}