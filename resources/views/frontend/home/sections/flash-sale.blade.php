<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }}) ">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('frontend.flash-sale') }}">see more <i
                                class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @forelse ($flashSaleItems as $item)
                @php
                    $product = $item->product;
                @endphp

                <!-- product details -->
                @include('frontend.components.single-product-content',compact('product'))
            @empty
                <p class="alert alert-danger">
                    No Products Found
                </p>
            @endforelse
        </div>
    </div>
</section>

<!-- PRODUCT MODAL VIEW START -->
@foreach ($flashSaleItems as $item)
    @php
        $product = $item->product;
    @endphp

    @include('frontend.components.modal-product-details', compact('product'))
@endforeach

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
