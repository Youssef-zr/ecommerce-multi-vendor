<!-- Product id -->
<input type="hidden" name="product_id" value="{{ $productId}}">

<!-- name field -->
<div class="form-group mb-3{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
    @if ($errors->any())
    <code>{{ $errors->first('name') }}</code>
    @endif
</div>

<!-- status field -->
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
            'class' => 'form-control',
            'required' => 'required',
        ],
    ) !!}

    @if ($errors->any())
        <code>{{ $errors->first('status') }}</code>
    @endif
</div>
