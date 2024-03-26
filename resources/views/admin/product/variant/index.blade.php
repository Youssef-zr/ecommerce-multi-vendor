@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product Variants</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card-btns mb-4">
                    <h4>
                        <a href="{{ route('admin.dashboard.product.index')  }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card">
                    <div class="card-header">

                        <h4>Product: {{ $product->name }}</h4>

                        <!-- add new -->
                        <div class="card-header-action">
                            <a href="{{ route('admin.dashboard.product-variant.create',["product"=>$product->id]) }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add new
                            </a>
                        </div>
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
        // change variant status
        $('body').on("click", 'input[name="status"]', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("admin.dashboard.product-variant.change-status") }}',
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
