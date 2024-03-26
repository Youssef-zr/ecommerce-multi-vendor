@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product Image Gallery</h1>
    </div>

    <div class="section-body">

        <!-- upload product images -->
        <div class="row">
            <div class="col-12">
                <div class="card-back mb-3 ml-1">
                    <a href="{{ route('admin.dashboard.product.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Product : ( {{ $product->name }} )</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.product.image-gallery.form')
                    </div>
                </div>
            </div>
        </div>

        <!-- product image gallery -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Images</h4>
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

        // change is featured brand status
        $('body').on("click", 'input[name="is_featured"]', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("admin.dashboard.brand.change-featured-status") }}',
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
