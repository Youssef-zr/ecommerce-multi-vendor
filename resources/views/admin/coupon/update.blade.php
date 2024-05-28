@extends('admin.layouts.master')

@section('title')
    - Edit Coupon
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Coupons</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard.coupon.index') }}">Coupons</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-edit"></i> Edit Coupon</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::model($coupon, ['method' => 'PUT', 'route' => ['admin.dashboard.coupon.update', $coupon->id]]) !!}
                            @include('admin.coupon.form')

                            {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
