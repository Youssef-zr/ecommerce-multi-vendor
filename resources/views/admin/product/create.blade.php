@extends('admin.layouts.master')

@section('title')
    - New Product
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard.product.index') }}">Products</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-plus-circle"></i> New Product</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::open([
                                'method' => 'POST',
                                'route' => 'admin.dashboard.product.store',
                                'enctype' => 'multipart/form-data',
                            ]) !!}

                            @include('admin.product.form')

                            {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
