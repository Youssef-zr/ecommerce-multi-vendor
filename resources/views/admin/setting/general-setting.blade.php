<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card">
        <div class="card-body">

            {!! Form::model($generalSetting, [
                'route' => ['admin.dashboard.settings.update', $generalSetting->id ?? 1],
                'method' => 'PUT',
            ]) !!}

            <!-- site name field -->
            <div class="form-group{{ $errors->has('site_name') ? ' has-error' : '' }}">
                {!! Form::label('site_name', 'Site Name', ['class' => 'form-label']) !!}
                {!! Form::text('site_name', old('site_name'), ['class' => 'form-control', 'required' => 'required']) !!}
                @if ($errors->any())
                    <code>{{ $errors->first('site_name') }}</code>
                @endif
            </div>

            <!-- dashboard layout list -->
            <div class="form-group{{ $errors->has('layout') ? ' has-error' : '' }}">
                {!! Form::label('layout', 'Layout', ['class' => 'form-label']) !!}
                {!! Form::select(
                    'layout',
                    [
                        'RTL' => 'RTL',
                        'LTR' => 'LTR',
                    ],
                    old('layout'),
                    [
                        'id' => 'layout',
                        'class' => 'select2 d-block w-100',
                        'placeholer' => 'Please Select',
                        'required' => 'required',
                    ],
                ) !!}

                @if ($errors->any())
                    <code>{{ $errors->first('layout') }}</code>
                @endif
            </div>

            <!-- contact email field -->
            <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                {!! Form::label('contact_email', 'Contact Email', ['class' => 'form-label']) !!}
                {!! Form::text('contact_email', old('contact_email'), ['class' => 'form-control']) !!}
                @if ($errors->any())
                    <code>{{ $errors->first('contact_email') }}</code>
                @endif
            </div>


            <!-- default currency name list -->
            <div class="form-group{{ $errors->has('currency_name') ? ' has-error' : '' }}">
                {!! Form::label('currency_name', 'Default Currency Name', ['class' => 'form-label']) !!}
                {!! Form::select('currency_name', config('settings.currency_list'), old('currency_name'), [
                    'id' => 'currency_name',
                    'class' => 'select2 d-block w-100',
                    'placeholer' => 'Please Select',
                    'required' => 'required',
                ]) !!}

                @if ($errors->any())
                    <code>{{ $errors->first('currency_name') }}</code>
                @endif
            </div>

            <!-- timezone field -->
            <div class="form-group{{ $errors->has('time_zone') ? ' has-error' : '' }}">
                {!! Form::label('time_zone', 'TimeZone', ['class' => 'form-label']) !!}
                {!! Form::select('time_zone', config('settings.timezone'), old('time_zone'), [
                    'id' => 'time_zone',
                    'class' => 'select2 d-block w-100',
                    'placeholer' => 'Please Select',
                    'required' => 'required',
                ]) !!}

                @if ($errors->any())
                    <code>{{ $errors->first('time_zone') }}</code>
                @endif
            </div>

            <!-- btn submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}

        </div>
    </div>
</div>
