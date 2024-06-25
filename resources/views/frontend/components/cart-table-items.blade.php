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
                        @if (Cart::content()->count() > 0)
                        <a href="#" class="common_btn" id="clear-cart">clear cart</a>
                        @endif
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse(Cart::content() as $item)
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
