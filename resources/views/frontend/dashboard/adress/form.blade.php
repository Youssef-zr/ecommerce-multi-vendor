<div class="row">
    <!-- name field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
            {!! Form::text('name', old('name'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Name',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('name') }}</code>
            @endif
        </div>
    </div>

    <!-- email field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email *', ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Email',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('email') }}</code>
            @endif
        </div>
    </div>

    <!-- phone field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            {!! Form::label('phone', 'Phone *', ['class' => 'form-label']) !!}
            {!! Form::text('phone', old('phone'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'phone',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('phone') }}</code>
            @endif
        </div>
    </div>

    <!-- countries list -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('country') ? ' has-error' : '' }}">
            {!! Form::label('country', 'Country *', ['class' => 'form-label']) !!}
            <div class="wsus__topbar_select">
                {!! Form::select('country', config('settings.countries'), old('country'), [
                    'id' => 'country',
                    'class' => 'select_2 d-block w-100',
                    'placeholer' => 'Please Select',
                    'required' => 'required',
                ]) !!}

                @if ($errors->any())
                    <code>{{ $errors->first('country') }}</code>
                @endif
            </div>
        </div>
    </div>


    <!-- state field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('state') ? ' has-error' : '' }}">
            {!! Form::label('state', 'State *', ['class' => 'form-label']) !!}
            {!! Form::text('state', old('state'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'state',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('state') }}</code>
            @endif
        </div>
    </div>

    <!-- city field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            {!! Form::label('city', 'City *', ['class' => 'form-label']) !!}
            {!! Form::text('city', old('city'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'city',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('city') }}</code>
            @endif
        </div>
    </div>

    <!-- zip code field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
            {!! Form::label('zip_code', 'Zip Code *', ['class' => 'form-label']) !!}
            {!! Form::text('zip_code', old('zip_code'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'zip_code',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('Zip Code') }}</code>
            @endif
        </div>
    </div>

    <!-- Adress field -->
    <div class="col-xl-6 col-md-6">
        <div class="wsus__add_address_single form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
            {!! Form::label('adress', 'Adress *', ['class' => 'form-label']) !!}
            {!! Form::text('adress', old('adress'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'adress',
            ]) !!}
            @if ($errors->any())
                <code>{{ $errors->first('adress') }}</code>
            @endif
        </div>
    </div>
</div>
