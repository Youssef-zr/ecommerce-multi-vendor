@php
    $paypalSetting = \App\Models\PaypalSetting::find(1);
@endphp

<div class="tab-pane fade show active" id="list-paypal" role="tabpanel" aria-labelledby="list-paypal-list">
    <div class="card">
        <div class="card-body">
            {!! Form::model($paypalSetting, [
            'route' => ['admin.dashboard.paypal-setting.update', 1],
            'method' => 'PUT',
            ]) !!}

            <!-- status filed -->
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', 'Status *', ['class' => 'form-label']) !!}
                {!! Form::select(
                'status',
                [
                'active' => 'Active',
                'inactive' => 'Inactive',
                ],
                old('status'),
                [
                'id' => 'status',
                'class' => 'select2 d-block w-100',
                'placeholder' => 'Please Select',
                'required' => 'required',
                ],
                ) !!}

                @if ($errors->any())
                <code>{{ $errors->first('status') }}</code>
                @endif
            </div>

            <!-- account mode filed -->
            <div class="form-group{{ $errors->has('mode') ? ' has-error' : '' }}">
                {!! Form::label('account_mode', 'Account Mode *', ['class' => 'form-label']) !!}
                {!! Form::select(
                'account_mode',
                [
                'sandbox' => 'Sandbox',
                'live' => 'Live',
                ],
                old('account_mode'),
                [
                'id' => 'mode',
                'class' => 'select2 d-block w-100',
                'placeholder' => 'Please Select',
                'required' => 'required',
                ],
                ) !!}

                @if ($errors->any())
                <code>{{ $errors->first('account_mode') }}</code>
                @endif
            </div>

            <!-- country name list -->
            <div class="form-group{{ $errors->has('country_name') ? ' has-error' : '' }}">
                {!! Form::label('country_name', 'Country Name *', ['class' => 'form-label']) !!}
                {!! Form::select('country_name', config('settings.countries'), old('country_name'), [
                'id' => 'country_name',
                'class' => 'select2 d-block w-100',
                'placeholder' => 'Please Select',
                'required' => 'required',
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('country_name') }}</code>
                @endif
            </div>

            <!-- Currency name list -->
            <div class="form-group{{ $errors->has('currency_name') ? ' has-error' : '' }}">
                {!! Form::label('currency_name', 'Currency Name *', ['class' => 'form-label']) !!}
                {!! Form::select('currency_name', config('settings.currency_list'), old('currency_name'), [
                'id' => 'currency_name',
                'class' => 'select2 d-block w-100',
                'placeholder' => 'Please Select',
                'required' => 'required',
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('currency_name') }}</code>
                @endif
            </div>

            <!-- Current currency rate field -->
            <!-- this field used to chang any currency value to usd before complete the paypal payment -->
            <div class="form-group{{ $errors->has('currency_rate') ? ' has-error' : '' }}">
                {!! Form::label('currency_rate', 'Currency rate (per USD) *', ['class' => 'form-label']) !!}
                {!! Form::number('currency_rate', old('currency_rate'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Currency rate (Per USD)',
                'step'=>".1"
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('currency_rate') }}</code>
                @endif
            </div>

            <!-- sandbox paypal client id field -->
            <div class="form-group{{ $errors->has('sandbox_client_id') ? ' has-error' : '' }}">
                {!! Form::label('sandbox_client_id', 'Sandbox paypal client id *', ['class' => 'form-label']) !!}
                {!! Form::text('sandbox_client_id', old('sandbox_client_id'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Sandbox paypal client id',
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('sandbox_client_id') }}</code>
                @endif
            </div>

            <!-- sandbox paypal secrect id field -->
            <div class="form-group{{ $errors->has('sandbox_secret_key') ? ' has-error' : '' }}">
                {!! Form::label('sandbox_secret_key', 'Sandbox paypal secret key *', ['class' => 'form-label']) !!}
                {!! Form::text('sandbox_secret_key', old('sandbox_secret_key'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Sandbox paypal secret key',
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('sandbox_secret_key') }}</code>
                @endif
            </div>

            <!-- live paypal client id field -->
            <div class="form-group{{ $errors->has('live_client_id') ? ' has-error' : '' }}">
                {!! Form::label('live_client_id', 'Live paypal client id *', ['class' => 'form-label']) !!}
                {!! Form::text('live_client_id', old('live_client_id'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Live paypal client id',
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('live_client_id') }}</code>
                @endif
            </div>

            <!-- live paypal secrect key field -->
            <div class="form-group{{ $errors->has('live_secret_key') ? ' has-error' : '' }}">
                {!! Form::label('live_secret_key', 'Live paypal  secret key *', ['class' => 'form-label']) !!}
                {!! Form::text('live_secret_key', old('live_secret_key'), [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Live paypal secret key',
                ]) !!}

                @if ($errors->any())
                <code>{{ $errors->first('live_secret_key') }}</code>
                @endif
            </div>

            <!-- btn submit -->
            <button type="submit" class="btn btn-primary">Update</button>
            {!! Form::close() !!}

        </div>
    </div>
</div>
