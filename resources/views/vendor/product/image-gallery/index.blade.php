@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-list"></i> Product</h3>
            <div class="card-back mb-3 ml-1">
                <a href="{{ route('vendor.dashboard.product.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="my-1">Product : ( {{ $product->name }} )</h6>
                </div>
                <div class="card-body">
                    @include('vendor.product.image-gallery.form')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- product image gallery -->
<div class="row mt-4">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <div class="card">
                <div class="card-header">
                    <h6 class="my-1">All Images</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive w-100">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
