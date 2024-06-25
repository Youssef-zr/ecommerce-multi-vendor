<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Coupon;
use App\Models\Backend\Product;
use App\Models\Backend\ProductVariantItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\CouponService;
use Cart;

class CartController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    // add to cart
    public function addToCart(Request $request)
    {
        try {


            $product = Product::findOrFail($request->product_id); // find product

            $cartItemQty = $this->prepareProductCartQty($product, $request->qty); // check and return cart item + request qty

            $this->checkProductQtyStock($product, $cartItemQty); // check product qty stock

            $cartData = $this->prepareCartData($product, $request->qty); // prepare cart data and options

            Cart::add($cartData); // add to cart

            return response()->json([
                'status' => 'success',
                'message' => 'Added To Cart',
                'cartCount' => $this->cartCount(),
                'sidebarHtmlCartContent' => $this->sidebarHtmlCartContent(),
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }

    // return cart cata data and options
    private function prepareCartData($product, $qty)
    {
        $cartOptions = $this->fetchVariantOptions();
        $productPrice = $product->getPrice();

        return [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty,
            'weight' => 10,
            'price' =>  $productPrice,
            'options' => array_merge(
                (array)$cartOptions,
                [
                    'slug' => $product->slug,
                    'image' => $product->thumb_image,
                ]
            )
        ];
    }

    // fetch product variant options
    // variants total amount
    private function fetchVariantOptions()
    {
        $options = [];
        $totalAmount = 0;

        if (request()->variantItems != [])
            foreach (request()->variantItems as $item) {
                $variantItem = ProductVariantItem::with('variant')->where('id', $item)
                    ->select('id', 'name', 'price', 'variant_id')
                    ->firstOrFail();

                $options[$variantItem->variant->name] = $variantItem->only(['id', 'name', 'price']);
                $totalAmount += $variantItem->price;
            }

        return (object) ['variants' => $options, 'variantTotalPrice' => $totalAmount];
    }

    // show cart details
    public function cartDetails()
    {
        $cartItems = Cart::content();

        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    // check product qty stock
    public function checkProductQtyStock(Product $product, int $qty)
    {
        if ($product->qty == 0) {

            throw new Exception('Product Out Of Stock!', 409);
        } else if ($product->qty < $qty) {

            throw new Exception('Quantity Not Available!', 409);
        }
    }

    // retrieve a cart item by product ID
    public function getCartItemByProductId(int $productId)
    {
        return Cart::content()->filter(function ($item) use ($productId) {
            return $item->id == $productId;
        })->first();
    }

    // check cart item qty and prepare qty
    public function prepareProductCartQty(Product $product, int $qty = 0)
    {
        $cartItemQty = $this->getCartItemByProductId($product->id)->qty ?? 0;

        return $cartItemQty + $qty;
    }

    // update product qty
    public function updateProductQty(Request $request)
    {

        try {

            $product  = Product::findOrFail(Cart::get($request->productRowId)->id);

            $this->checkQtyAutorizedBeforeUpdate($product->id, $request->qty);

            $this->checkProductQtyStock($product, $request->qty);

            Cart::update($request->productRowId, $request->qty);
            $totalAmount = $this->getProductTotalAmount($request->productRowId);

            return response()->json([
                'status' => 'success',
                'message' => 'Product Quantity Updated',
                'totalAmount' => $totalAmount,
                'sidebarHtmlCartContent' => $this->sidebarHtmlCartContent(),
                'cartSubTotalHtmlContent' => $this->cartSubTotalHtmlContent(),
            ], Response::HTTP_OK);
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }

    // check the qty autorized before upate cart item qty
    // for example cant update update when (cart item qty = 1 and request qty = 1)
    public function checkQtyAutorizedBeforeUpdate(int $productId, int $qty)
    {
        $cartItemQty = $this->getCartItemByProductId($productId) ? $this->getCartItemByProductId($productId)->qty : null;

        if ($cartItemQty != null and $cartItemQty == 1 and $qty == 1) {
            throw new Exception('You Cant Update Qty to 0 !', 422);
        }
    }

    // get product total price
    public function getProductTotalAmount($rowId)
    {
        $product = Cart::get($rowId);
        $totalAmount = ($product->qty * $product->price) + $product->options->variantTotalAmount;

        return $totalAmount;
    }

    // get cart count items
    public function cartCount()
    {
        return Cart::content()->count();
    }

    // clear cart
    public function clearCart()
    {
        Cart::destroy();
        session()->forget('coupon');

        return response()->json([
            'status' => 'success',
            'message' => 'Cart Cleared Successfully!',
            'cartCount' => $this->cartCount(),
            'sidebarHtmlCartContent' => $this->sidebarHtmlCartContent(),
            'cartHtmlTableContent' => $this->cartHtmlTableContent(),
            'cartSubTotalHtmlContent' => $this->cartSubTotalHtmlContent(),
        ], Response::HTTP_OK);
    }

    // delete item from cart
    public function deleteCartItem()
    {
        Cart::remove(request()->rowId);

        return response()->json([
            'status' => 'success',
            'message' => 'Item Deleted Successfully!',
            'cartCount' => $this->cartCount(),
            'sidebarHtmlCartContent' => $this->sidebarHtmlCartContent(),
            'cartHtmlTableContent' => $this->cartHtmlTableContent(),
            'cartSubTotalHtmlContent' => $this->cartSubTotalHtmlContent(),

        ], Response::HTTP_OK);
    }

    // apply coupon
    public function applyCoupon(Request $request)
    {
        return $this->couponService->applyCoupon($request);
    }


    // sidebar cart items using with ajax requests (add and delete and update) cart items
    public function sidebarHtmlCartContent()
    {
        return view(
            'frontend.components.sidebar-shoping-cart',
            ['sidebarCartItems' => Cart::content()]
        )->render();
    }

    //  cart sub total view content using only with update in cart items page
    public function cartSubTotalHtmlContent()
    {
        return view(
            'frontend.components.cart-sub-total',
        )->render();
    }

    // cart table items html view
    public function cartHtmlTableContent()
    {

        return view('frontend.components.cart-table-items')
            ->render();
    }
}
