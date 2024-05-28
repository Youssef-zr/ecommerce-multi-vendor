@extends('admin.layouts.master')

@section('title')
    - Sellers Products
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sellers Products</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Products</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>All Sellers Products</h4>
                        </div>
                        <div class="card-body">
                            {{-- for search  --}}
                            <div class="card-actions mb-5">
                                @include('admin.product.seller-product.form-search')
                            </div>

                            <div class="table-responsive w-100">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    url: '{{ route("admin.dashboard.product.change-status") }}',
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

            // change proruct is approved
            $('body').on("change", 'select[name="is_approved"]', function() {
                let id = $(this).data('id');
                let isApproved = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("admin.dashboard.seller-product.change-approved") }}',
                    method: 'put',
                    data: {
                        isApproved,
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
