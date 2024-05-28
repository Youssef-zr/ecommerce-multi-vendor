@extends('admin.layouts.master')

@section('title')
    - Edit Brand
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Brands</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.dashboard.brand.index') }}">Brands</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-edit"></i> Edit Brand</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($brand, [
                        'route' => ['admin.dashboard.brand.update', $brand->id],
                        'method' => 'PUT',
                        "enctype"=>"multipart/form-data"
                        ]) !!}
                        @include('admin.brand.form')
                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
