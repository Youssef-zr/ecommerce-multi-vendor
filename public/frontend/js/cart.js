// change sider cart content
let changeSidebarCartContent = (content) => {
    let sidebarCatItemEl = $(".sidebar-cat-items");
    sidebarCatItemEl.html(content);
};

// change cart total items
let cartTotalItems = (total) => {
    const cartTotalEl = $(".cart-count-item");
    cartTotalEl.text(total);
};

// remove table row item
let removeRowItem = (tr) => {
    let tableBody = $(".cart-table-items tbody");

    tr.remove();

    if (tableBody.children("tr:not(.cart-empty-message)").length == 0) {
        $(".cart-empty-message").removeClass("d-none");
        $("#clear-cart").addClass("d-none");
    }
};

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
        success: function (res) {
            if (res.status == "success") {
                toastr.success(res.message);

                // change cart count items
                cartTotalItems(res.cartCount);

                // change sidebar cart content
                changeSidebarCartContent(res.sidebarCartContent);
            }
        },
        error: function (xhr, status, error) {
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
        success: function (res) {
            if (res.status == "success") {
                toastr.success(res.message);
                options.productTotalEl.text(res.totalAmount);

                // change sidebar cart content
                changeSidebarCartContent(res.sidebarCartContent);
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status == 409) {
                error = xhr.responseJSON.message;
                toastr.error(error);
            } else {
                toastr.error(error);
            }
        },
    });
};

// delete cart item
let deleteCartItem = (url, formData) => {
    return new Promise((resolve, reject) => {
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
                            changeSidebarCartContent(res.sidebarCartContent);

                            // return a promise success
                            resolve();
                        } else if (response.status == "error") {
                            //show message error
                            swalFireMessage(
                                "Opps...",
                                "Something went wrong!",
                                "error"
                            );

                            // return promise error
                            reject();
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status == 409) {
                            error = xhr.responseJSON.msg;
                            toastr.error(error);
                        }

                        //show message error
                        swalFireMessage("Opps...", error, "error");

                        // return promise error
                        reject();
                    },
                });
            }
        });
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
                success(response, status, xhr) {
                    if (
                        xhr.status >= 200 &&
                        xhr.status < 300 &&
                        response.status == "success"
                    ) {
                        // message success
                        swalFireMessage(
                            "Cleared!",
                            response.message,
                            "success"
                        );

                        window.location.reload();
                    } else if (response.status == "error") {
                        swalFireMessage(
                            "Opps...",
                            "Something went wrong!",
                            "error"
                        );
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.status == 409) {
                        error = xhr.responseJSON.msg;
                        toastr.error(error);
                    } else {
                        swalFireMessage("Opps...", error, text);
                    }
                },
            });
        }
    });
};
