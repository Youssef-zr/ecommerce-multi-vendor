@extends('admin.layouts.master')

@section('title')
    - New Variant Item
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product variant item</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card-btns mb-4">
                    <a href="{{ route('admin.dashboard.product-variant.index',["product"=>$variant->product_id]) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Create new varient item</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open([
                        'method' => 'POST',
                        'route' => ['admin.dashboard.product-variant-item.store',$variant->id],
                        ]) !!}

                        @include('admin.product.variant-item.form')

                        {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
