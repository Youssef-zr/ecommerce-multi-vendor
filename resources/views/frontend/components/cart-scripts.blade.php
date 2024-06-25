@push('js')

<script>
    // change cart form sub total content
    let cartSubTotalHtmlContent = (content) => {
        let cartTotalContent = $(".cart-total-content");
        cartTotalContent.html(content);
    };

    // change sider cart content
    let changeSidebarHtmlCartContent = (content) => {
        let sidebarCatItemEl = $(".sidebar-cat-items");
        sidebarCatItemEl.html(content);
    };

    // change cart total items
    let cartTotalItems = (total) => {
        const cartTotalEl = $(".cart-count-item");
        cartTotalEl.text(total);
    };

    // change cart table content
    let changeCartTableContent = (content) => {
        let cartContentEl = $(".cart-content");
        cartContentEl.html(content);
    };

    // ---------- ajax request methods -------------

    // ajax csrf
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // add to cart
    let addToCart = (url, formData) => {
        // You can now send the serialized data via AJAX or handle it as needed
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            success: function(res) {
                if (res.status == "success") {
                    toastr.success(res.message);

                    // change cart count items
                    cartTotalItems(res.cartCount);

                    // change sidebar cart content
                    changeSidebarHtmlCartContent(res.sidebarHtmlCartContent);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status == 409) {
                    error = xhr.responseJSON.message;
                    toastr.error(error);
                } else {
                    toastr.error(error);
                }
            },
        });
    };

    // update item cart qty
    let updateCartQty = (url, formData, options = {}) => {
        $.ajax({
            url,
            type: "POST",
            data: formData,
            success: function(res) {
                if (res.status == "success") {
                    toastr.success(res.message);
                    options.productTotalEl.text(res.totalAmount);

                    // change sidebar cart content
                    changeSidebarHtmlCartContent(res.sidebarHtmlCartContent);

                    //change cart sub total total content
                    cartSubTotalHtmlContent(res.cartSubTotalHtmlContent);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status == 409) {
                    error = xhr.responseJSON.message;
                    toastr.error(error);
                } else if (xhr.status == 422) {
                    // cart item qty equal 1 can't update to 0
                    error = xhr.responseJSON.message;
                    toastr.warning(error);

                    // swalFireMessage('Opps...',error, 'warning');
                    Swal.fire({
                        title: "Opps...",
                        width: 300,
                        height: 140,
                        icon: "warning",
                        text: error,
                        background: "#fff",
                        backdrop: `
                      rgba(0,0,123,0.4)
                      url("https://sweetalert2.github.io/images/nyan-cat.gif")
                      left top
                      no-repeat
                    `,
                    });
                } else {
                    toastr.error(error);
                }
            },
        });
    };

    // delete cart item
    let deleteCartItem = (url, formData) => {
        Swal.fire(
            swalOptions(
                undefined,
                "This Action will delete prodcut from your cart !",
                "warning",
                true,
                undefined,
                undefined,
                "Yes, delete it!"
            )
        ).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url,
                    type: "GET",
                    data: formData,
                    success(res, status, xhr) {
                        if (
                            xhr.status >= 200 &&
                            xhr.status < 300 &&
                            res.status == "success"
                        ) {
                            // message success
                            swalFireMessage("Removed!", res.message, "success");

                            // change cart total items
                            cartTotalItems(res.cartCount);

                            // change sidebar cart content
                            changeSidebarHtmlCartContent(
                                res.sidebarHtmlCartContent
                            );

                            // change cart table content
                            changeCartTableContent(res.cartHtmlTableContent);

                            //change cart sub total total content
                            cartSubTotalHtmlContent(res.cartSubTotalHtmlContent);

                            // rerender cart item number plus and minus btns
                            $.getScript("/frontend/js/jquery.nice-number.min.js");

                        } else if (response.status == "error") {
                            //show message error
                            swalFireMessage(
                                "Opps...",
                                "Something went wrong!",
                                "error"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 409) {
                            error = xhr.responseJSON.msg;
                            toastr.error(error);
                        }

                        //show message error
                        swalFireMessage("Opps...", error, "error");
                    },
                });
            }
        });
    };

    // clear cart items
    let clearCartItems = (url) => {

        Swal.fire(
            swalOptions(
                undefined,
                "This Action will clear your cart !",
                "warning",
                true,
                undefined,
                undefined,
                "clear it!"
            )
        ).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url,
                    type: "GET",
                    success(res, status, xhr) {
                        if (
                            xhr.status >= 200 &&
                            xhr.status < 300 &&
                            res.status == "success"
                        ) {
                            // message success
                            swalFireMessage("Cleared!", res.message, "success");

                            // change cart total items
                            cartTotalItems(res.cartCount);

                            // change sidebar cart content
                            changeSidebarHtmlCartContent(
                                res.sidebarHtmlCartContent
                            );

                            // change cart table content
                            changeCartTableContent(res.cartHtmlTableContent);

                            //change cart sub total total content
                            cartSubTotalHtmlContent(res.cartSubTotalHtmlContent);
                        } else if (res.status == "error") {
                            swalFireMessage(
                                "Opps...",
                                "Something went wrong!",
                                "error"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 409) {
                            error = xhr.responseJSON.msg;
                            toastr.error(error);
                        } else {
                            swalFireMessage("Opps...", error, "error");
                        }
                    },
                });
            }
        });
    };

    // apply coupon
    let applyCoupon = (url, formData) => {
        $.ajax({
            url,
            type: "GET",
            data: formData,
            success: function(res) {
                if (res.status == "success") {
                    toastr.success(res.message);

                    getCartSubTotalContent();
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status == 409) {

                    error = xhr.responseJSON.message;
                    toastr.error(error);
                } else if (xhr.status == 400) {

                    // cart item qty equal 1 can't update to 0
                    error = xhr.responseJSON.message;
                    toastr.error(error);

                } else {
                    toastr.error(error);
                }
            },
        });
    };

    // get cart sub total html content to update
    let getCartSubTotalContent = () => {
        $.ajax({
            url: "{{ route('frontend.get-cart-total') }}",
            type: "GET",
            success: function(res, status) {
                if (status == "success") {
                    //change cart sub total total content
                    cartSubTotalHtmlContent(res);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status == 409) {

                    error = xhr.responseJSON.message;
                    toastr.error(error);
                } else if (xhr.status == 400) {

                    // cart item qty equal 1 can't update to 0
                    error = xhr.responseJSON.message;
                    toastr.error(error);

                } else {
                    toastr.error(error);
                }
            },
        });
    }
</script>
@endpush
