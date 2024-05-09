@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Flash Sale</h1>
    </div>

    <!-- flash sale end_date -->
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Flash Sale End Date</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'put', 'route' => 'admin.dashboard.flash-sale.update']) !!}
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                    {!! Form::label('end_date', 'Sale End Date') !!}
                                    {!! Form::text('end_date', old('end_date', @$flashSale->end_date), [
                                    'class' => 'form-control datepicker',
                                    'required' => 'required',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('end_date') }}</small>
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- flash sale add products -->
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Flash Sale Add Products</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'put', 'route' => 'admin.dashboard.flash-sale.add-product']) !!}
                        <!-- product id field list -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                                    {!! Form::label('product_id', 'Products') !!}
                                    {!! Form::select('product_id', $products, old('product_id'), [
                                    'placeholder' => 'Please Select',
                                    'id' => 'product_id',
                                    'class' => 'd-block w-100 select2',
                                    'required' => 'required',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('product_id') }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- show_at_home and status fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('show_at_home') ? ' has-error' : '' }}">
                                    {!! Form::label('show_at_home', 'Show At Home') !!}
                                    {!! Form::select('show_at_home', ['yes' => 'Yes', 'no' => 'No'], old('show_at_home'), [
                                    'placeholder' => 'Please Select',
                                    'id' => 'show_at_home',
                                    'class' => 'd-block w-100 select2',
                                    'required' => 'required',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('show_at_home') }}</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    {!! Form::label('status', 'Status') !!}
                                    {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], old('status'), [
                                    'placeholder' => 'Please Select',
                                    'id' => 'status',
                                    'class' => 'd-block w-100 select2',
                                    'required' => 'required',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Flash Sale Product List</h4>
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

        // change flash sale status
        $('body').on("click", 'input[name="status"]', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("admin.dashboard.flash-sale.change-product-status") }}',
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

        // change flash sale show_at_home status
        $('body').on("click", 'input[name="show_at_home"]', function() {
            let id = $(this).data('id');
            let isChecked = $(this).is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route("admin.dashboard.flash-sale.show-home-status") }}',
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
