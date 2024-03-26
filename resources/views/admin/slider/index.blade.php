@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Sliders</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Sliders</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sliders List</h4>
                        {{-- add new  --}}
                        <div class="card-header-action">
                            <a href="{{ route('admin.dashboard.slider.create') }}" class="btn btn-primary">
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
@endpush
