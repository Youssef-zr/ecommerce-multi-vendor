@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-list"></i> Product Variants</h3>
            <div class="add-new d-flex justify-content-between">
                <a href="{{ route('vendor.dashboard.product.index',['product'=>$product->id]) }}" class="btn btn-primary btn-sm mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                <a href="{{ route('vendor.dashboard.product-variant.create',['product'=>$product->id]) }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Create New</a>
            </div>
            <div class="card">
                <div class="card-header mb-3">
                    <p class="text-dark"><strong>Product:</strong> {{ $product->name }}</p>
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

<script>
    $(() => {
        // change brand status
        $('body').on("click", 'input[name="status"]', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("vendor.dashboard.product-variant.change-status") }}',
                method: 'put',
                data: {
                    isChecked,
                    id
                },
                success(res) {
                    toastr.success("Status updated successfully", 'OK!');
                },
                error(err) {
                    toastr.error('There is an error please try again later!!', 'Error!');
                }
            })
        })

    })
</script>
@endpush
