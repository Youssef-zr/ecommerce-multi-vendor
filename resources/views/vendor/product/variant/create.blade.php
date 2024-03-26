@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-list"></i> Product Variant</h3>
            <div class="card-back mb-3 ml-1">
                <a href="{{ route('vendor.dashboard.product-variant.index',['product'=>$productId]) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
            <div class="card">
                <h5 class="card-header py-3">
                    New Variant
                </h5>
                <div class="card-body">
                    {!! Form::open([
                    'method' => 'POST',
                    'route' => 'vendor.dashboard.product-variant.store',
                    ]) !!}

                    @include('vendor.product.variant.form')

                    {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right mt-3']) !!}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
