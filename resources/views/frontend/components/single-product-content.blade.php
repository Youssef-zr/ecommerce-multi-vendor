<div class="col-xl-3 col-sm-6 col-lg-4">
    <div class="wsus__product_item">
        <span class="wsus__new">{{ productType($product->product_type) }}</span>
        @if (hasDiscount($product))
        <span class="wsus__minus">-{{ percentageDiscount($product->price, $product->offer_price) }}%</span>
        @endif
        <a class="wsus__pro_link" href="{{ route('frontend.product_detail', $product->slug) }}">
            <img src="{{ url($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_1" />
            <img src="{{ url(get2ndProductImage($product)) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
        </a>
        <ul class="wsus__single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#product-id-{{ $product->id }}"><i class="far fa-eye"></i></a>
            </li>
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
            <a class="wsus__pro_name" href="{{ route('frontend.product_detail', $product->slug) }}">{{ $product->name }}</a>

            @if (hasDiscount($product))
            <p class="wsus__price">{!! $setting->currency_icon !!}{{ $product->offer_price }}
                <del>{!! $setting->currency_icon !!}{{ $product->price }}</del>
            </p>
            @else
            <p class="wsus__price">{!! $setting->currency_icon !!}{{ $product->price }}</p>
            @endif
            <!-- Start form add to cart -->
            {!! Form::open(['method' => 'POST', 'class' => 'add-cart-form']) !!}
            {!! Form::hidden('product_id', $product->id) !!}
            {!! Form::hidden('qty', 1) !!}
            @if ($product->variants->count() > 0)
            @foreach ($product->variants as $productVariant)
            @if ($productVariant->variantItems->count() > 0)
            <select class="d-none" name="variantItems[]">
                @foreach ($productVariant->variantItems as $variantItem)
                <option value="{{ $variantItem->id }}" {{ $variantItem->is_default ? 'selected' : '' }}>
                    {{ $variantItem->name }}
                    ({!! $setting->currency_icon !!}{{ $variantItem->price }})
                </option>
                @endforeach
            </select>
            @endif
            @endforeach
            @endif
            <a href="#" type="submit" class="add_cart">add to cart</a>
            {!! Form::close() !!}
            <!-- End form add to cart -->
        </div>
    </div>
</div>
