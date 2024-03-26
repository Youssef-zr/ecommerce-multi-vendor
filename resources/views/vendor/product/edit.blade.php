@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-list"></i> Product</h3>
            <div class="btn-action mt-4">
                <a href="{{ route('vendor.dashboard.product.index') }}" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">
                    <div class="add-new d-flex justify-content-start mb-4">
                        <p><i class="fa fa-pencil-square"></i> Edit product</p>
                    </div>
                    <div class="form">
                        {!! Form::model($product, [
                        'route' => ['vendor.dashboard.product.update', $product->id],
                        'method' => 'PUT',
                        "enctype"=>"multipart/form-data"
                        ]) !!}
                        @include('vendor.product.form')

                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
