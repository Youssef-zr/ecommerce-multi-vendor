@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-list"></i> Product Variant Item</h3>
            <div class="card-back mb-3 ml-1">
                <a href="{{ route('vendor.dashboard.product-variant.index',['product'=>$variant->product_id]) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
            <div class="card">
                <h6 class="card-header py-3">
                    New Variant Item
                </h6>
                <div class="card-body">
                    {!! Form::open([
                    'method' => 'POST',
                    'route' => ['vendor.dashboard.product-variant-item.store',$variant->id],
                    ]) !!}

                    @include('vendor.product.variant-item.form')

                    {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
