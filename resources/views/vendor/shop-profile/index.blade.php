@extends('vendor.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile</h3>
            <div class="wsus__dashboard_profile">

                <!-- errors  -->
                @if ($errors->any())
                <ul class="alert alert-danger my-3">
                    @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="wsus__dash_pro_area">

                    {!! Form::model($vendor, [
                    'route' => ['vendor.dashboard.shop-profile.update', $vendor->id],
                    'method' => 'PUT',
                    "enctype"=>"multipart/form-data"
                    ]) !!}

                    @include('vendor.shop-profile.form')

                    {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .form-group{
        margin-bottom: 15px;
    }
</style>
@endpush
