@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-list"></i> Product</h3>
            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">
                    <div class="add-new d-flex justify-content-start mb-4">
                        <p><i class="fa fa-plus"></i> Create new product</p>
                    </div>
                    <div class="form">
                        {!! Form::open([
                        'method' => 'POST',
                        'route' => 'vendor.dashboard.product.store',
                        'enctype' => 'multipart/form-data',
                        ]) !!}

                        @include('vendor.product.form')

                        {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
