@extends('frontend.layouts.master')

@section('title')
    - Flash Sale
@endsection

@section('content')
    <!-- BREADCRUMB START -->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ route('frontend.index') }}">home</a></li>
                            <li><a href="javascript:void(0);">Flash Sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


    <!-- DAILY DEALS DETAILS START -->
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

                        <!-- product details -->
                        @include('frontend.components.single-product-content', compact('product'))
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
    <!--  DAILY DEALS DETAILS END -->

    <!-- PRODUCT MODAL VIEW START -->
    @foreach ($flashSaleItems as $item)
        @php
            $product = $item->product;
        @endphp

        @include('frontend.components.modal-product-details', compact('product'))
    @endforeach
    <!-- PRODUCT MODAL VIEW END -->
@endsection

<!-- custom script -->
@push('js')
    <script>
        $(() => {
            const date = new Date("{{ $flashSale->end_date ?? '' }}");

            if (date !== '') {
                // default example
                simplyCountdown('.simply-countdown-one', {
                    year: date.getFullYear(),
                    month: date.getMonth() + 1,
                    day: date.getDate(),
                    enableUtc: false
                });
            }

            // add to cart by submit form
            $('.add_cart').on('click', function(e) {
                e.preventDefault();

                $(this).submit()
            })
        })
    </script>
@endpush
