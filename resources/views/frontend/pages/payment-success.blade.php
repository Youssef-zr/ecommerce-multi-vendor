@extends('frontend.layouts.master')

@section('title')
- Cart details
@endsection

@section('content')

<!--============================
        BREADCRUMB START
    ==============================-->
<section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>payment</h4>
                    <ul>
                        <li><a href="{{ route('frontend.index') }}">home</a></li>
                        <li><a href="{{ route('user.payment') }}">payment</a></li>
                        <li><a href="javascript:void(0)">success</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        BREADCRUMB END
    ==============================-->


<!--============================
        PAYMENT PAGE START
    ==============================-->
<section id="wsus__cart_view">
    <div class="container">
        <div class="wsus__pay_info_area">
            Payment Success
        </div>
    </div>
</section>
<!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection
