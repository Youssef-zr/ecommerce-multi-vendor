<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend/images/flash_sell_bg.jpg') }}) ">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="{{ route('frontend.flash-sale') }}">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @forelse ($flashSaleItems as $item )
            @php
            $product = $item->product;
            @endphp

            <div class="col-xl-3 col-sm-6 col-lg-4">
                <div class="wsus__product_item">
                    <span class="wsus__new">{{ productType($product->product_type) }}</span>
                    @if (hasDiscount($product))
                    <span class="wsus__minus">-{{ percentageDiscount($product->price,$product->offer_price) }}%</span>
                    @endif
                    <a class="wsus__pro_link" href="product_details.html">
                        <img src="{{ url($product->thumb_image) }}" alt="product" class="img-fluid w-100 img_1" />
                        <img src="{{ url(get2ndProductImage($product)) }}" alt="product" class="img-fluid w-100 img_2" />
                    </a>
                    <ul class="wsus__single_pro_icon">
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-eye"></i></a></li>
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
                        <p class="wsus__price">{!! $setting->currency_icon !!}{{ $product->offer_price }} <del>{!! $setting->currency_icon !!}{{ $product->price }}</del></p>
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
    </div>
</section>

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
