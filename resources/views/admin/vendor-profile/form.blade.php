<div class="row">

    <!-- banner field -->
    @if (isset($vendor) and File::exists($vendor->banner))
        <div class="col-12">
            <div class="form-group">
                <label class="form-label">Preview</label>
                <img src="{{ asset($vendor->banner) }}" alt="{{ $vendor->name }}" class="form-control" style="width: 250px;height:100px">
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
            {!! Form::label('banner', 'banner', ['class' => 'form-label']) !!}
            {!! Form::file('banner', ['class' => 'w-100']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('banner') }}</code>
            @endif
        </div>
    </div>

    <!-- shop_name field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('shop_name') ? ' has-error' : '' }}">
            {!! Form::label('shop_name', 'Shop Name', ['class' => 'form-label']) !!}
            {!! Form::text('shop_name', old('shop_name'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('shop_name') }}</code>
            @endif
        </div>
    </div>

    <!-- name field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('name') }}</code>
            @endif
        </div>
    </div>

    <!-- email field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'email', ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('email') }}</code>
            @endif
        </div>
    </div>

    <!-- phone field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            {!! Form::label('phone', 'phone', ['class' => 'form-label']) !!}
            {!! Form::text('phone', old('phone'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => '13527935133',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('phone') }}</code>
            @endif
        </div>
    </div>

    <!-- adress field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
            {!! Form::label('adress', 'adress', ['class' => 'form-label']) !!}
            {!! Form::text('adress', old('adress'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('adress') }}</code>
            @endif
        </div>
    </div>

    <!-- description field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {!! Form::label('description', 'description', ['class' => 'form-label']) !!}
            {!! Form::textarea('description', old('description'), [
                'class' => 'summernote',
                'required' => 'required',
                'style' => 'min-height:130px;max-height:230px',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('description') }}</code>
            @endif
        </div>
    </div>

    <!-- facebook field field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('fb_link') ? ' has-error' : '' }}">
            {!! Form::label('fb_link', 'Facebook', ['class' => 'form-label']) !!}
            {!! Form::text('fb_link', old('fb_link'), ['class' => 'form-control',"placeholder"=>'https://www.facebook.com/profile_name']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('fb_link') }}</code>
            @endif
        </div>
    </div>

    <!-- twitter field field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('tw_link') ? ' has-error' : '' }}">
            {!! Form::label('tw_link', 'Twitter', ['class' => 'form-label']) !!}
            {!! Form::text('tw_link', old('tw_link'), ['class' => 'form-control',"placeholder"=>'https://www.twitter.com/profile_name']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('tw_link') }}</code>
            @endif
        </div>
    </div>

    <!-- instagram field field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('insta_link') ? ' has-error' : '' }}">
            {!! Form::label('insta_link', 'Instagram', ['class' => 'form-label']) !!}
            {!! Form::text('insta_link', old('insta_link'), ['class' => 'form-control',"placeholder"=>'https://www.instagram.com/profile_name']) !!}
            @if ($errors->any())
                <code>{{ $errors->first('insta_link') }}</code>
            @endif
        </div>
    </div>

</div>

