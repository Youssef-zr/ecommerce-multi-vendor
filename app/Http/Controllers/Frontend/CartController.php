<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\ProductVariantItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cart;

class CartController extends Controller
{
    // add to cart
    public function addToCart(Request $request)
    {
        try {

            $product = Product::findOrFail($request->product_id);
            $this->checkProductQtyStock($product, $request->qty);

            $cartData = $this->prepareCartData($product, $request->qty);
            Cart::add($cartData);

            return response()->json([
                'status' => 'success',
                'message' => 'Added To Cart',
                'cartCount' => $this->cartCount(),
                'sidebarCartContent' => $this->sidebarCartContent(),
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
    public function checkProductQtyStock($product, $qty)
    {
        if ($product->qty == 0) {
            throw new Exception('Product Out Of Stock!', 409);
        } else if ($product->qty < $qty) {
            throw new Exception('Quantity Not Available!', 409);
        }
    }

    // update product qty
    public function updateProductQty(Request $request)
    {
        
        try {
            $product  = Product::findOrFail(Cart::get($request->productRowId)->id);

            $this->checkProductQtyStock($product, $request->qty);

            Cart::update($request->productRowId, $request->qty);
            $totalAmount = $this->getProductTotalAmount($request->productRowId);

            return response()->json([
                'status' => 'success',
                'message' => 'Product Quantity Updated',
                'totalAmount' => $totalAmount,
                'sidebarCartContent' => $this->sidebarCartContent(),
            ], Response::HTTP_OK);

        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], $e->getCode());
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

    // sidebar cart items using with ajax requests (add and delete and update) cart items
    public function sidebarCartContent()
    {
        return view(
            'frontend.components.sidebar-shoping-cart',
            ['sidebarCartItems' => Cart::content()]
        )->render();
    }

    // clear cart
    public function clearCart()
    {
        Cart::destroy();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart Cleared Successfully!',
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
            'sidebarCartContent' => $this->sidebarCartContent(),
        ], Response::HTTP_OK);
    }
}
