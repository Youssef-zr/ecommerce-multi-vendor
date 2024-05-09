@extends('frontend.layouts.master')

@section('content')
    <!--============================
                BREADCRUMB START
            ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>daily deals</h4>
                        <ul>
                            <li><a href="{{ route('frontend.index') }}">home</a></li>
                            <li><a href="javascript:void(0);">daily deals</a></li>
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
            DAILY DEALS DETAILS START
        ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_2.png') }}" alt="banner"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('frontend/images/offer_banner_3.png') }}" alt="banner"
                                class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse ($flashSaleItems as $item)
                        @php
                            $product = $item->product;
                        @endphp

                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($product->product_type) }}</span>
                                @if (hasDiscount($product))
                                    <span
                                        class="wsus__minus">-{{ percentageDiscount($product->price, $product->offer_price) }}%</span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('frontend.product_detail',$product->slug) }}">
                                    <img src="{{ url($product->thumb_image) }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100 img_1" />
                                    <img src="{{ url(get2ndProductImage($product)) }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100 img_2" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="#">{{ $product->mainCategory->name }} </a>
                                    <p class="wsus__pro_rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>(133 review)</span>
                                    </p>
                                    <a class="wsus__pro_name" href="#">{{ $product->name }}</a>

                                    @if (hasDiscount($product))
                                        <p class="wsus__price">{!! $setting->currency_icon !!}{{ $product->offer_price }}
                                            <del>{!! $setting->currency_icon !!}{{ $product->price }}</del></p>
                                    @else
                                        <p class="wsus__price">{!! $setting->currency_icon !!}{{ $product->price }}</p>
                                    @endif
                                    <a class="add_cart" href="#">add to cart</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="alert alert-danger">
                            No Products Found
                        </p>
                    @endforelse
                </div>

                <!-- pagination -->
                <div class="flash-sale-links mt-5  d-flex  justify-content-center">
                    @if ($flashSaleItems->hasPages())
                        {{ $flashSaleItems->links() }}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--============================
            DAILY DEALS DETAILS END
        ==============================-->
@endsection


@push('js')
    <script>
        $(() => {
            let date = new Date("{{ $flashSale->end_date }}");

            // default example
            simplyCountdown('.simply-countdown-one', {
                year: date.getFullYear(),
                month: date.getMonth() + 1,
                day: date.getDate(),
                enableUtc: false
            });
        })
    </script>
@endpush
