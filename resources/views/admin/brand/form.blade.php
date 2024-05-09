<div class="row">

    <!-- image field -->
    @if (isset($brand))
    <div class="col-12">
        <div class="form-group">
            <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}" class="img-thumbnail">
        </div>
    </div>
    @endif

    <div class="col-12">
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            {!! Form::label('image', 'image', ['class' => 'form-label']) !!}
            {!! Form::file('image', ['class'=>'w-100']) !!}
            @if ($errors->any())
            <code>{{ $errors->first('image') }}</code>
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
            'class' => 'd-block w-100 select2',
            'required' => 'required',
            ],
            ) !!}

            @if ($errors->any())
            <code>{{ $errors->first('status') }}</code>
            @endif
        </div>
    </div>

    <!-- is_featured field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('is_featured') ? ' has-error' : '' }}">
            {!! Form::label('is_featured', 'Is featured', ['class' => 'form-label']) !!}
            {!! Form::select(
            'is_featured',
            [
            'active' => 'active',
            'inactive' => 'inactive',
            ],
            old('is_featured'),
            [
            'id' => 'is_featured',
            'class' => 'd-block w-100 select2',
            'required' => 'required',
            ],
            ) !!}

            @if ($errors->any())
            <code>{{ $errors->first('is_featured') }}</code>
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
