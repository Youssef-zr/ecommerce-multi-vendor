<div class="row">

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

    <!-- icon field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
            {!! Form::label('icon', 'Icon', ['class' => 'form-label']) !!}
            <!-- Div tag -->
            <div role="iconpicker" name='icon' id="icon" data-icon="{{ isset($category) ? $category->icon :"" }}" data-rows="3" data-cols="6" data-align="left"></div>

            @if ($errors->any())
            <code>{{ $errors->first('icon') }}</code>
            @endif
        </div>
    </div>

    <!-- Status field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}
            {!! Form::select(
            'status',
            [
            'active' => 'active',
            'inactive' => 'inactive',
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
    </div>
</div>

@push('css')
<!-- Bootstrap-Iconpicker -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}">

@endpush

@push('js')
<!-- bootstrap iconpicker -->
<script src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<script>
    $(() => {
        $("input[name='icon']").val($("#icon").data('icon'))
    })
</script>
@endpush
