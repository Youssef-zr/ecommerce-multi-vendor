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
                        <li><a href="#">home</a></li>
                        <li><a href="#">peoduct</a></li>
                        <li><a href="#">payment</a></li>
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
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="wsus__payment_menu" id="sticky_sidebar">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link common_btn active" id="v-pills-paypal-tab" data-bs-toggle="pill" data-bs-target="#v-pills-paypal" type="button" role="tab" aria-controls="v-pills-paypal" aria-selected="true">
                                Paypal
                            </button>
                            <button class="nav-link common_btn" id="v-pills-strip-tab" data-bs-toggle="pill" data-bs-target="#v-pills-strip" type="button" role="tab" aria-controls="v-pills-strip" aria-selected="true">
                                strip
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                        <!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-xl-12 m-auto">
                                    <div class="wsus__payment_area">
                                        <form>
                                            <div class="wsus__pay_caed_header">
                                                <h5>credit or debit card</h5>
                                                <img src="{{ asset("frontend/images/payment5.png") }}" alt="payment" class="img-=fluid">
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <input class="input" type="text" placeholder="MD. MAHAMUDUL HASSAN SAZAL">
                                                </div>
                                                <div class="col-12">
                                                    <input class="input" type="text" placeholder="2540 4587 **** 3215">
                                                </div>
                                                <div class="col-4">
                                                    <input class="input" type="text" placeholder="MM/YY">
                                                </div>
                                                <div class="col-4 ms-auto">
                                                    <input class="input" type="text" placeholder="1234">
                                                </div>
                                            </div>
                                            <div class="wsus__save_payment">
                                                <h6><i class="fas fa-user-lock"></i> 100% secure payment with :</h6>
                                                <img src="{{ asset("frontend/images/payment1.png") }}" alt="payment" class="img-fluid">
                                                <img src="{{ asset("frontend/images/payment2.png") }}" alt="payment" class="img-fluid">
                                                <img src="{{ asset("frontend/images/payment3.png") }}" alt="payment" class="img-fluid">
                                            </div>
                                            <div class="wsus__save_card">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">save thid Card</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="common_btn">confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- paypal tab -->
                        <div class="tab-pane active" id="v-pills-paypal" role="tabpanel" aria-labelledby="v-pills-paypal-tab">
                            <form class="wsus__input_area">
                                <button type="submit" class="common_btn w-100 d-block">Pay with paypal</button>
                            </form>
                        </div>

                        <!-- strip tab -->
                        <div class="tab-pane" id="v-pills-strip" role="tabpanel" aria-labelledby="v-pills-strip-tab">
                            <form class="wsus__input_area">
                                <button type="submit" class="common_btn w-100 d-block">Pay with strip</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                        <h5>Booking Summary</h5>
                        <p>subtotal: <span>{!! $setting->currency_icon !!}{{ getCartSubTotal() }}</span></p>
                        <p>shipping fee: <span>{!! $setting->currency_icon !!}{{ getShippingFee() }} </span></p>
                        <p>coupon(-): <span>{!! $setting->currency_icon !!}{{ getCartDiscount() }}</span></p>
                        <h6>total <span>{!! $setting->currency_icon !!}{{ getFinalPayableAmount() }}</span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection

<!-- show form adress if errors -->
@if (isset($errors) and !$errors->isEmpty())
@push('js')
<script>
    $(() => {

    })
</script>
@endpush
@endif

@push('js')
<script>
    $(() => {

    });
</script>
@endpush
