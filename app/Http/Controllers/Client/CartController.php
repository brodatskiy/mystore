<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItem\CartItemResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getItems();

        return Inertia::render('Client/Cart/Index', [
            'products' => CartItemResource::collection($cartItems),
            'total' => Cart::getTotal()
        ]);
    }

    public function add(Product $product): RedirectResponse
    {
        Cart::add($product);

        return back();
    }

    public function increase(Product $product)
    {
        Cart::increase($product);

        return back();
    }

    public function decrease(Product $product)
    {
        Cart::decrease($product);

        return back();
    }

    public function destroy(Product $product): RedirectResponse
    {
        Cart::destoyItem($product);

        return back();
    }
}
