<h6>total cart</h6>
<p>subtotal: <span>${{ getCartSubTotal() }}</span></p>
<p>delivery: <span>$00.00</span></p>
<p>discount(-): <span>{!! $setting->currency_icon !!}{{ getCartDiscount() }}</span></p>
<p class="total"><span>total:</span> <span>{!! $setting->currency_icon !!}{{ getMainCartTotal() }}</span></p>
