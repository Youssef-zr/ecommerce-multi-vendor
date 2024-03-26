<!-- get vendors -->
@php
    $vendors = App\Models\Backend\Vendor::pluck('shop_name', 'id')->toArray();
@endphp


{!! Form::open([
    'method' => 'get',
    'route' => 'admin.dashboard.seller-product.filter',
    'class' => 'form-horizontal',
]) !!}

<div class="row">

    <!-- vendors field -->
    <div class="col-md-3 col-lg-2">
        <div class="form-group">
            {!! Form::label('vendor', 'Vendor') !!}
            {!! Form::select('vendor', $vendors, old('vendor', request()->get('vendor')), [
                'id' => 'vendor',
                'class' => 'form-control',
                'placeholder' => 'Please select',
            ]) !!}
        </div>
    </div>

    <!-- approvied field -->
    <div class="col-md-3 col-lg-2">
        <div class="form-group">
            {!! Form::label('approved', 'Approve') !!}
            {!! Form::select(
                'approved',
                [
                    'pending' => 'pending',
                    'approved' => 'approved',
                ],
                old('approved', request()->get('approved')),
                [
                    'id' => 'approved',
                    'class' => 'form-control',
                    'placeholder' => 'Please select',
                ],
            ) !!}
        </div>
    </div>

    <!-- status field -->
    <div class="col-md-3 col-lg-2">
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select(
                'status',
                [
                    'active' => 'active',
                    'inactive' => 'inactive',
                ],
                old('status', request()->get('status')),
                [
                    'id' => 'status',
                    'class' => 'form-control',
                    'placeholder' => 'Please select',
                ],
            ) !!}
        </div>
    </div>

    <!-- type field -->
    <div class="col-md-3 col-lg-2 mb-0">
        <div class="form-group">
            {!! Form::label('type', 'Type') !!}
            {!! Form::select(
                'type',
                [
                    'undefined' => 'Undefined',
                    'best' => 'Best',
                    'new_arrival' => 'New Arrival',
                    'feature' => 'Feature',
                    'top' => 'Top',
                    'flash_deal' => 'Flash Deal',
                ],
                old('type', request()->get('type')),
                [
                    'id' => 'type',
                    'class' => 'form-control',
                    'placeholder' => 'Please select',
                ],
            ) !!}
        </div>
    </div>

</div>
<!-- button submit -->
<div class="form-group">
    <button class="btn btn-primary mt-0" type="submit">
        <i class="fa fa-search"></i>
        Search
    </button>
</div>

{!! Form::close() !!}
