@extends('admin.layouts.master')

@section('content')
<section class="section">
<div class="section-header">
        <h1>Product variant item</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card-btns mb-4">
                    <a href="{{ route('admin.dashboard.product-variant.index',["product"=>$variantItem->product_id]) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">
                      <h4>Edit variant item</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($variantItem, [
                        'route' => ['admin.dashboard.product-variant-item.update', $variantItem->id],
                        'method' => 'PUT',
                        ]) !!}
                        @include('admin.product.variant-item.form')
                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
