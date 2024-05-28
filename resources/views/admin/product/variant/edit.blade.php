@extends('admin.layouts.master')

@section('title')
    - Edit Variant
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Variants</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.dashboard.product-variant.index', ['product' => $product_id]) }}"
                                class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <div class="card-body">
                            {!! Form::model($variant, [
                                'route' => ['admin.dashboard.product-variant.update', $variant->id],
                                'method' => 'PUT',
                            ]) !!}
                            @include('admin.product.variant.form')
                            {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
