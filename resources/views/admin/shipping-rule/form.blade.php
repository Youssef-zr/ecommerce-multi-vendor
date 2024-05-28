<!-- name field -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
    @if ($errors->any())
        <code>{{ $errors->first('name') }}</code>
    @endif
</div>

<!-- type field -->
<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    {!! Form::label('type', 'Type *', ['class' => 'form-label']) !!}
    {!! Form::select(
        'type',
        [
            'flat_cost' => 'Flat Cost',
            'min_cost' => 'Minmum Order Amount',
        ],
        old('type'),
        [
            'id' => 'type',
            'class' => 'd-block w-100 select2',
            'required' => 'required',
        ],
    ) !!}

    @if ($errors->any())
        <code>{{ $errors->first('type') }}</code>
    @endif
</div>

<!-- min_cost field -->
<div class="form-group min-cost d-none {{ $errors->has('min_cost') ? ' has-error' : '' }}">
    {!! Form::label('min_cost', 'Min Amount', ['class' => 'form-label']) !!}
    {!! Form::number('min_cost', old('min_cost'), ['class' => 'form-control']) !!}
    @if ($errors->any())
        <code>{{ $errors->first('min_cost') }}</code>
    @endif
</div>

<!-- cost field -->
<div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
    {!! Form::label('cost', 'Cost *', ['class' => 'form-label']) !!}
    {!! Form::number('cost', old('cost'), ['class' => 'form-control', 'required' => 'required']) !!}
    @if ($errors->any())
        <code>{{ $errors->first('cost') }}</code>
    @endif
</div>

<!-- Status field -->
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
            'class' => 'd-block w-100 select2',
            'required' => 'required',
        ],
    ) !!}

    @if ($errors->any())
        <code>{{ $errors->first('status') }}</code>
    @endif
</div>

@push('js')
    <script>
        $(document).ready(function() {
            let type = $('#type');
            let minCost = $('.min-cost');

            type.on('change', function() {
                if (type.val() !== 'min_cost') {
                    minCost.addClass('d-none');
                } else {
                    minCost.removeClass('d-none');
                }
            })

        })
    </script>
@endpush

<!-- check min_cost value in edit mode -->
@isset($shippingRule)
    @push('js')
        <script>
            $(document).ready(function() {
                let $shippingRule = {!! json_encode($shippingRule) !!};

                if ($shippingRule.type == 'min_cost' && $shippingRule.min_cost != '') {
                    $('.min-cost').removeClass('d-none');
                }
            })
        </script>
    @endpush
@endisset

<!-- show min_cost field where old('type')== min_cost -->
@if (old('type') == 'min_cost')
    @push('js')
        <script>
            $(document).ready(function() {
                $('.min-cost').removeClass('d-none');
            })
        </script>
    @endpush
@endif
