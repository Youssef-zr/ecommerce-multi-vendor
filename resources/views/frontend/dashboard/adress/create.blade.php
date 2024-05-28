@extends('frontend.dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>Create address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
                {!! Form::open(['method' => 'POST', 'route' => 'user.dashboard.adress.store']) !!}
                @include('frontend.dashboard.adress.form')
                <button type="submit" class="common_btn">Create</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
