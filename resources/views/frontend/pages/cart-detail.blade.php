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

                <!-- cart list table items -->
                <div class="cart-content">
                    @include('frontend.components.cart-table-items',compact('cartItems'))
                </div>

            </div>

            <div class="col-xl-3">
                <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                    <!-- cart sub total card -->
                    <div class="cart-total-content">
                        @include('frontend.components.cart-sub-total')
                    </div>

                    <form id="coupon_form">
                        <input type="text" name="coupon_code" placeholder="Coupon Code">
                        <button type="submit" class="common_btn" id="apply-coupon">apply</button>
                    </form>

                    <a class="common_btn mt-4 w-100 text-center" href="{{ route("user.checkout.index") }}">checkout</a>
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
        $('body').on('click', '#clear-cart', function(e) {
            e.preventDefault();

            const url = "{{ route('frontend.cart.clear-items') }}";
            clearCartItems(url);
        })

        // delete cart item
        $('.cart-content').on('click', '.delete-cart-item', function(e) {
            e.preventDefault();

            const rowId = $(this).data('rowid');
            const formData = {
                'rowId': rowId
            };
            const url = "{{ route('frontend.cart.delete-item') }}";

            deleteCartItem(url, formData);
        })

        // apply coupon code
        $('body').on('click','#apply-coupon', function(e) {
            e.preventDefault();

            const url = "{{ route('frontend.apply-coupon') }}"
            const formData = $('#coupon_form').serialize();

            applyCoupon(url, formData);
        })

    })
</script>
@endpush
