<ul class="border-bottom-0 pb-2">

    @forelse ($sidebarCartItems as $item)
    <li class="border-bottom pb-3 mb-1 mt-2">
        <div class="wsus__cart_img">
            <a href="{{ route('frontend.product_detail', $item->options->slug) }}"><img src="{{ asset($item->options->image) }}" alt="{{ $item->name }}" class="img-fluid w-100 border rounded-2"></a>
            <a class="wsis__del_icon" href="#" data-rowid="{{ $item->rowId }}"><i class="fas fa-minus-circle"></i></a>
        </div>

        <div class="wsus__cart_text">
            <a class="wsus__cart_title" href="{{ route('frontend.product_detail', $item->options->slug) }}">{{ $item->name }}</a>

            @if ($item->options->variants != [])
            <div class="product-options">
                @foreach ($item->options->variants as $variant => $variantItem)
                <span class="d-block">{{ $variant }} : {{ $variantItem['name'] }}
                    ({!! $setting->currency_icon !!}{{ $variantItem['price'] }})
                </span>
                @endforeach
            </div>
            @endif

            <p>
                ({!! $setting->currency_icon !!}{{ $item->price }} x {{ $item->qty }})
                @if ($item->options->variantTotalAmount > 0)
                + {!! $setting->currency_icon !!}{{ $item->options->variantTotalAmount }}
                @endif
            </p>

            <hr class="my-2">

            <span class="badge bg-primary tex-light">
                {!! $setting->currency_icon !!}{{ $item->price * $item->qty + $item->options->variantTotalAmount }}
            </span>
        </div>
    </li>
    @empty
    <li>
        <span class="d-block w-100 alert alert-default border-bottom mb-0">
            Cart Is Empty!
        </span>
    </li>
    @endforelse
</ul>

<h5>sub total <span>{!! $setting->currency_icon !!}{{ \Cart::total() }}</span></h5>

<div class="wsus__minicart_btn_area">
    <a class="common_btn" href="{{ route('frontend.cart.cart-details') }}">view cart</a>
    <a class="common_btn" href="check_out.html">checkout</a>
</div>


@push('js')
<script>
    $(() => {
        // delete item from cart
        $('body').on('click', '.wsis__del_icon', function(e) {
            e.preventDefault();

            const formData = {
                'rowId': $(this).data('rowid')
            };
            const url = "{{ route('frontend.cart.delete-item') }}";

            deleteCartItem(url, formData)

        });
    })
</script>
@endpush
