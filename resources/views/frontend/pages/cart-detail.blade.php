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
                    <h4>Cart</h4>
                    <ul>
                        <li><a href="{{ route('frontend.index') }}">home</a></li>
                        <li><a href="javascript:void(0);">Cart Details</a></li>
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
        <div class="row">
            <div class="col-xl-9">
                <div class="wsus__cart_list">
                    <div class="table-responsive">
                        <table class="cart-table-items">
                            <thead>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name">
                                        product details
                                    </th>

                                    <th class="wsus__pro_tk">
                                        unit price
                                    </th>

                                    <th class="wsus__pro_tk">
                                        total
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>

                                    <th class="wsus__pro_icon">
                                        @if ($cartItems->count() > 0)
                                        <a href="#" class="common_btn" id="clear-cart">clear cart</a>
                                        @endif
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($cartItems as $item)
                                <tr class="d-flex" id="row-{{ $item->rowId }}">
                                    <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}" alt="product" class="img-fluid w-100">
                                    </td>

                                    <td class="wsus__pro_name">
                                        <p>{{ $item->name }}</p>

                                        @if ($item->options->variants != [])
                                        @foreach ($item->options->variants as $variant => $variantItem)
                                        <span>{{ $variant }} : {{ $variantItem['name'] }}
                                            ({!! $setting->currency_icon !!}{{ $variantItem['price'] }})
                                        </span>
                                        @endforeach
                                        @endif
                                    </td>

                                    <td class="wsus__pro_tk">
                                        <h6>{!! $setting->currency_icon !!}{{ $item->price }}</h6>
                                    </td>
                                    <td class="wsus__pro_tk">
                                        <h6>{!! $setting->currency_icon !!}<span id="{{ $item->rowId }}">{{ $item->price * $item->qty + $item->options->variantTotalAmount }}
                                        </h6>
                                    </td>

                                    <td class="wsus__pro_select">
                                        <div class="select_number">
                                            <input class="number_area" name="product-qty" type="text" min="1" max="100" value="{{ $item->qty }}" data-rowid="{{ $item->rowId }}" />
                                        </div>
                                    </td>


                                    <td class="wsus__pro_icon">
                                        <a href="#" class="delete-cart-item" data-rowid="{{ $item->rowId }}"><i class="far fa-times"></i></a>
                                    </td>
                                </tr>

                                @empty
                                <tr class="cart-empty-message">
                                    <td colspan="5">
                                        <span class="alert alert-secondary text-center d-block w-100 my-2 ms-2">
                                            Cart is empty
                                        </span>
                                    </td>
                                </tr>
                                @endforelse

                                <!-- show when cart empty -->
                                <tr class="cart-empty-message d-none">
                                    <td colspan="5">
                                        <span class="alert alert-secondary text-center d-block w-100 my-2 ms-2">
                                            Cart is empty
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                    <h6>total cart</h6>
                    <p>subtotal: <span>$124.00</span></p>
                    <p>delivery: <span>$00.00</span></p>
                    <p>discount: <span>$10.00</span></p>
                    <p class="total"><span>total:</span> <span>$134.00</span></p>

                    <form>
                        <input type="text" placeholder="Coupon Code">
                        <button type="submit" class="common_btn">apply</button>
                    </form>
                    <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                    <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i class="fab fa-shopify"></i> go shop</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="wsus__single_banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="wsus__single_banner_content">
                    <div class="wsus__single_banner_img">
                        <img src="{{ asset('frontend/images/single_banner_2.jpg') }}" alt="banner" class="img-fluid w-100">
                    </div>
                    <div class="wsus__single_banner_text">
                        <h6>sell on <span>35% off</span></h6>
                        <h3>smart watch</h3>
                        <a class="shop_btn" href="#">shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="wsus__single_banner_content single_banner_2">
                    <div class="wsus__single_banner_img">
                        <img src="{{ asset('frontend/images/single_banner_3.jpg') }}" alt="banner" class="img-fluid w-100">
                    </div>
                    <div class="wsus__single_banner_text">
                        <h6>New Collection</h6>
                        <h3>Cosmetics</h3>
                        <a class="shop_btn" href="#">shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CART VIEW PAGE END -->
@endsection

@push('js')

<script>
    $(() => {

        // update product cart qty
        $('body').on('click', '.add,.sub', function() {
            let qtyEl = $(this).siblings('input[name="product-qty"]');
            let rowId = qtyEl.data('rowid');
            let productTotalEl = $(`#${rowId}`);

            // form data
            const formData = {
                'qty': qtyEl.val(),
                "productRowId": rowId
            };
            const url = "{{ route('frontend.cart.update-product-qty') }}";

            // You can now send the serialized data via AJAX or handle it as needed
            if (formData.qty >= 1) {
                updateCartQty(url, formData, {
                    productTotalEl
                })
            }
        })

        // clear cart items
        $('#clear-cart').click(function(e) {
            e.preventDefault();

            const url = "{{ route('frontend.cart.clear-items') }}";
            clearCartItems(url);
        })

        // delete cart item
        $('.delete-cart-item').on('click', function(e) {
            e.preventDefault();

            const rowId = $(this).data('rowid');
            const formData = {
                'rowId': rowId
            };
            const url = "{{ route('frontend.cart.delete-item') }}";

            deleteCartItem(url, formData).then((response) => {
                // remove item from table
                let trContainer = $(`#row-${rowId}`);
                removeRowItem(trContainer);
            })

        })

    })
</script>
@endpush
