<section class="product_popup_modal">
    <div class="modal fade" id="product-id-{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="row">

                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if ($product->video_link != '')
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="{{ $product->video_link }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                @endif

                                <div class="row modal_slider">
                                    @if ($product->imageGallery)
                                        @foreach ($product->imageGallery as $productImage)
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($productImage->image) }}"
                                                        alt="{{ $product->name }}" class="img-fluid w-100">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}"
                                                class="img-fluid w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="#">{{ $product->name }}</a>
                                <p class="wsus__stock_area">
                                    <span class="in_stock">{{ $product->qty == 0 ? 'Out of stock' : 'in stock' }} </span>
                                    ({{ $product->qty }} item)
                                </p>

                                @if (hasDiscount($product))
                                    <h4>${{ $product->offer_price }} <del>${{ $product->price }}</del></h4>
                                @else
                                    <h4>${{ $product->price }}</h4>
                                @endif

                                <p class="review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>20 review</span>
                                </p>
                                <p class="description">
                                    {{ $product->short_description }}
                                </p>

                                <!-- Start form add to cart -->
                                {!! Form::open(['method' => 'POST', 'class' => 'add-cart-form']) !!}

                                {!! Form::hidden('product_id', $product->id) !!}

                                @if ($product->variants->count() > 0)
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            @foreach ($product->variants as $productVariant)
                                                @if ($productVariant->variantItems->count() > 0)
                                                    <div class="col-xl-6 col-sm-6">
                                                        <h5 class="mb-2">{{ $productVariant->name }}:</h5>
                                                        <select class="select_2" name="variantItems[]">
                                                            @foreach ($productVariant->variantItems as $variantItem)
                                                                <option value="{{ $variantItem->id }}"
                                                                    {{ $variantItem->is_default ? 'selected' : '' }}>
                                                                    {{ $variantItem->name }}
                                                                    ({!! $setting->currency_icon !!}{{ $variantItem->price }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="wsus__quentity">
                                    <h5>quantity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="qty" type="text" min="1"
                                            max="100" value="1" />
                                    </div>
                                </div>

                                <ul class="wsus__button_area">
                                    <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                    <li><a class="buy_now" href="#">buy now</a></li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-random"></i></a></li>
                                </ul>

                                {!! Form::close() !!}
                                <!-- End form add to cart -->

                                @if ($product->brand?->name != null)
                                    <p class="brand_model"><span>Brand :</span> {{ $product->brand->name }}</p>
                                @endif

                                <div class="wsus__pro_det_share">
                                    <h5>share :</h5>
                                    <ul class="d-flex">
                                        {!! $product->shareProductLinks() !!}
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
