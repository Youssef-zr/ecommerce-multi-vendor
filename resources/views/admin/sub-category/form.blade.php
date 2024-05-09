<div class="row">

    <!-- Category id field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            {!! Form::label('category_id', 'Select Category *', ['class' => 'form-label']) !!}
            {!! Form::select(
            'category_id',$categories,
            old('category_id'),
            [
            'id' => 'category_id',
            'class' => 'd-block w-100 select2',
            'required' => 'required'
            ],
            ) !!}

            @if ($errors->any())
            <code>{{ $errors->first('category_id') }}</code>
            @endif
        </div>
    </div>

    <!-- name field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name *', ['class' => 'form-label']) !!}
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
</div>
