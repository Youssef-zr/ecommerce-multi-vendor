@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Sub Categories</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.dashboard.sub-category.index') }}">Sub Categories</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-edit"></i> Edit Category</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($subCategory, [
                        'route' => ['admin.dashboard.sub-category.update', $subCategory->id],
                        'method' => 'PUT',
                        ]) !!}
                        @include('admin.sub-category.form')
                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection