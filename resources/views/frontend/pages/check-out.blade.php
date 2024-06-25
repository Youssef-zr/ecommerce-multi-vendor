@extends('frontend.layouts.master')

@section('title')
    - Cart details
@endsection

@section('content')
    <!-- BREADCRUMB START -->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>check out</h4>
                        <ul>
                            <li><a href="{{ route('frontend.index') }}">home</a></li>
                            <li><a href="javascript:void(0);">product</a></li>
                            <li><a href="javascript:void(0);">check out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->

    <!-- CART VIEW PAGE START -->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__checkout_form">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>
                                Billing Details
                                <a href="#" class="open-adress-modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    add new address
                                </a>
                            </h5>

                            <div class="row">
                                @foreach ($userAdress as $adress)
                                    <div class="col-xl-6">
                                        <div class="wsus__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input form-check-adress" type="radio"
                                                    name="flexRadioDefault" id="adress-{{ $adress->id }}"
                                                    value="{{ $adress->id }}">
                                                <label class="form-check-label" for="adress-{{ $adress->id }}">
                                                    Select Address
                                                </label>
                                            </div>
                                            <ul>
                                                <li><span>Name :</span> {{ $adress->name }}</li>
                                                <li><span>Phone :</span> {{ $adress->phone }}</li>
                                                <li><span>Email :</span> {{ $adress->email }}</li>
                                                <li><span>Country :</span> {{ $adress->country }}</li>
                                                <li><span>City :</span> {{ $adress->city }}</li>
                                                <li><span>Zip Code :</span> {{ $adress->zip_code }}</li>
                                                <li><span>Address :</span> {{ $adress->adress }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details position-relative" id="sticky_sidebar">

                            <!-- Shipping Rules -->
                            @if ($shippingRules)
                                <p class="wsus__product">shipping Methods</p>
                                @foreach ($shippingRules as $method)
                                    @if (($method->type = 'min_cost') and getCartSubTotal() >= $method->min_cost)
                                        <div class="form-check">
                                            <input class="form-check-input shipping-method-val" type="radio"
                                                name="exampleRadios" id="method-{{ $method->id }}"
                                                value="{{ $method->id }}" data-cost='{{ $method->cost }}'>
                                            <label class="form-check-label" for="method-{{ $method->id }}">
                                                {{ $method->name }}
                                                <span>{!! $setting->currency_icon !!}({{ $method->cost }})</span>
                                            </label>
                                        </div>
                                    @elseif ($method->type == 'flat_cost')
                                        <div class="form-check">
                                            <input class="form-check-input shipping-method-val" type="radio"
                                                name="exampleRadios" id="method-{{ $method->id }}"
                                                value="{{ $method->id }}">
                                            <label class="form-check-label" for="method-{{ $method->id }}">
                                                {{ $method->name }}
                                                <span>{!! $setting->currency_icon !!}({{ $method->cost }})</span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{!! $setting->currency_icon !!}{{ getCartSubTotal() }}</span></p>
                                <p>shipping fee(+): <span>{!! $setting->currency_icon !!}<label id="shopping-fee">0</label></span>
                                </p>
                                <p>coupon(-): <span>{!! $setting->currency_icon !!}{{ getCartDiscount() }}</span></p>
                                <p><b>total:</b> <span><b>{!! $setting->currency_icon !!}<span
                                                class="cart-total">{{ getMainCartTotal() }}</span></b></span></p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input" id="agree-condition" type="checkbox" value="">
                                    <label class="form-check-label" for="agree-condition">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>


                            <!-- start from place order -->
                            {!! Form::open(['method' => 'POST', 'id' => 'place-order-form']) !!}
                            {!! Form::hidden('shipping-method', null, ['id' => 'shipping-method']) !!}
                            {!! Form::hidden('shipping-adress', null, ['id' => 'shipping-adress']) !!}

                            <button class="common_btn btn-submit d-flex align-items-center justify-content-center"
                                style="gap: 10px">
                                <i class="fa fa-spin fa-2x fa-spinner d-none" id="loader"></i>
                                Place Order
                            </button>
                            {!! Form::close() !!}
                            <!-- end form place order -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            {!! Form::open(['method' => 'POST', 'route' => 'user.checkout.add-adress']) !!}
                            @include('frontend.dashboard.adress.form')
                            <button type="submit" class="common_btn">Create</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART VIEW PAGE END -->
@endsection

<!-- show form adress if errors -->
@if (isset($errors) and !$errors->isEmpty())
    @push('js')
        <script>
            $(() => {
                $("#exampleModal").modal("show");

            })
        </script>
    @endpush
@endif

@push('js')
    <script>
        $(() => {
            // calculate shipping total
            $('input.shipping-method-val').on('click', function() {
                // change form shippping method id
                const id = $(this).val();
                $('input[name="shipping-method"]').val(id)

                // calculate shipping total
                const cost = $(this).data('cost');

                let currentCartAmount = "{{ getMainCartTotal() }}";
                let totalAmount = parseInt(cost) + parseInt(currentCartAmount);

                $('#shopping-fee').text(cost);
                $(".cart-total").text(totalAmount)
            });

            // change form shipping adress id
            $('input.form-check-adress').on('click', function() {
                const value = $(this).val();
                $('input[name="shipping-adress"]').val(value)
            });

            // submit form place order


            $('#place-order-form').on('submit', function(e) {
                e.preventDefault();

                if ($('#shipping-adress').val() == "") {
                    toastr.error('Shipping adress is required!')
                } else if ($('#shipping-method').val() == "") {
                    toastr.error('Shipping method is required!')
                } else if ($("#agree-condition").prop('checked') == false) {
                    toastr.error('You have to agree website term and conditions!')
                } else {

                    // ajax csrf
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    $.ajax({
                        url: "{{ route('user.checkout.form-submit') }}",
                        data: $(this).serialize(),
                        method: "POST",
                        beforeSend() {
                            $("#loader").removeClass('d-none');
                        },
                        success(res) {
                            if (res.status == "success") {
                                $('#loader').addClass('d-none');

                                // redirect to payment page
                                window.location.href = res.redirect_to;
                            }
                        },
                        error(err) {
                            console.log(err);
                        }
                    })
                }

            })

        })
    </script>
@endpush
