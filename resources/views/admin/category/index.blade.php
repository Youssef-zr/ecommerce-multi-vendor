@extends('admin.layouts.master')

@section('title')
    - Categories
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Categories</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Categories</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Categories List</h4>
                        {{-- add new  --}}
                        <div class="card-header-action">
                            <a href="{{ route('admin.dashboard.category.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add New
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
        $('body').on("click", 'input[name="status"]', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("admin.dashboard.category.change-status") }}',
                method: 'put',
                data: {
                    isChecked,
                    id
                },
                success(res) {
                    toastr.success("Status updated successfully", 'OK!');
                },
                error(err) {
                    toastr.success('There is an error please try again later!!', 'Error!');
                }
            })
        })
    })
</script>
@endpush
