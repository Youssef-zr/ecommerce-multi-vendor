<div class="row">

    @isset($slider)
    @if ($slider->banner!='')
    <!-- show banner -->
    <div class="col-12">
        <div class="image-prev">
            <div class="form-group">
                <label for="" class="d-block">Preview</label>
                <div class="mb-3 img-thumbnail" style="width:150px">
                    <img src="{{ asset($slider->banner) }}" alt="{{ $slider->title }}" style="max-width: 100%;object-fit: cover; ">
                </div>
            </div>
        </div>
    </div>
    @endif
    @endisset

    <!-- banner field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
            {!! Form::label('banner', 'Banner', ['class' => 'form-label']) !!}
            {!! Form::file('banner', ['class' => ['w-100']]) !!}
            @if ($errors->any())
            <code>{{ $errors->first('banner') }}</code>
            @endif
        </div>
    </div>

    <!-- type field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
            {!! Form::label('type', 'Type', ['class' => 'form-label']) !!}
            {!! Form::text('type', old('type'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
            <code>{{ $errors->first('type') }}</code>
            @endif
        </div>
    </div>

    <!-- title field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!}
            {!! Form::text('title', old('title'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
            <code>{{ $errors->first('title') }}</code>
            @endif
        </div>
    </div>

    <!-- starting_price field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('starting_price') ? ' has-error' : '' }}">
            {!! Form::label('starting_price', 'Starting price', ['class' => 'form-label']) !!}
            {!! Form::number('starting_price', old('starting_price'), ['min'=>"1",'step'=>'0.1','class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
            <code>{{ $errors->first('starting_price') }}</code>
            @endif
        </div>
    </div>

    <!-- serial field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('serial') ? ' has-error' : '' }}">
            {!! Form::label('serial', 'Serial', ['class' => 'form-label']) !!}
            {!! Form::number('serial', old('serial'), ['min'=>0,'class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
            <code>{{ $errors->first('serial') }}</code>
            @endif
        </div>
    </div>

    <!-- btn url field -->
    <div class="col-12">
        <div class="form-group{{ $errors->has('btn_url') ? ' has-error' : '' }}">
            {!! Form::label('btn_url', 'Btn url', ['class' => 'form-label']) !!}
            {!! Form::text('btn_url', old('btn_url'), ['class' => 'form-control', 'required' => 'required']) !!}
            @if ($errors->any())
            <code>{{ $errors->first('btn_url') }}</code>
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
