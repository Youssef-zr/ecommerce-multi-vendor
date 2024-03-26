<!-- variant name field just for show -->
<div class="form-group">
    {!! Form::label('variant_name', 'Variant Name', ['class' => 'form-label']) !!}
    {!! Form::text('variant_name', old('variant_name',$variant->name), [
    'class' => 'form-control',
    'required' => 'required',
    'placeholder' => 'Variant Name',
    'disabled'=>true,
    'readonly'=>true
    ]) !!}
</div>

<!-- name field -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Item name', ['class' => 'form-label']) !!}
    {!! Form::text('name', old('name'), [
    'class' => 'form-control',
    'required' => 'required',
    'placeholder' => 'Variant Item Name',
    ]) !!}
    @if ($errors->any())
    <code>{{ $errors->first('name') }}</code>
    @endif
</div>

<!-- price field -->
<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    <label for="price" class="form-label">Price <code>(Set 0 for make it free)</code></label>
    {!! Form::number('price', old('price'), [
    'class' => 'form-control',
    'required' => 'required',
    'placeholder' => 'Variant price Item',
    'min' => 0,
    'step' => 0.1,
    ]) !!}
    @if ($errors->any())
    <code>{{ $errors->first('price') }}</code>
    @endif
</div>

<!-- is_default field -->
<div class="form-group{{ $errors->has('is_default') ? ' has-error' : '' }}">
    {!! Form::label('is_default', 'Is Default *', ['class' => 'form-label']) !!}
    {!! Form::select(
    'is_default',
    [
    '' => 'Please select',
    'yes' => 'Yes',
    'no' => 'No',
    ],
    old('is_default'),
    [
    'id' => 'is_default',
    'class' => 'form-control',
    'required' => 'required',
    ],
    ) !!}

    @if ($errors->any())
    <code>{{ $errors->first('status') }}</code>
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
