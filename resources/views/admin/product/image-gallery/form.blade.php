<!-- image errors  -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{!! Form::open([
'method' => 'POST',
'route' => 'admin.dashboard.image-gallery.store',
'class' => 'form-horizontal',
"enctype"=>"multipart/form-data"
]) !!}

<!-- product id -->
<input type="hidden" name="product_id" value="{{ $product->id }}">

<!-- imagee field -->
<div class="form-group mb-3{{ $errors->has('image[]') ? ' has-error' : '' }}">
    <label for="image" class="form-label">
        Image <code>(Multiple image supported)</code>
    </label>
    {!! Form::file('image[]', ['class' => 'w-100', 'multiple' => true,'required'=>true]) !!}
    @if ($errors->any())
    <code>{{ $errors->first('image[]') }}</code>
    @endif
</div>

{!! Form::submit('Upload', ['class' => 'btn btn-primary pull-right']) !!}
{!! Form::close() !!}
