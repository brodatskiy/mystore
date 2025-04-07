<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItem\CartItemResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function order()
    {
        if (auth()->check()) {
            try {
                DB::beginTransaction();

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total' => Cart::getTotal(),
                    'status' => 'Unpaid'
                ]);

                $cartItems = Cart::getItems();

                foreach ($cartItems as $cartItem) {
                    $order->orderItems()->create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'price' => $cartItem->price,
                        'quantity' => $cartItem->quantity,
                    ]);
                }

                Cart::get()->delete();

                Db::commit();

                return back();
            } catch (Exception $exeption) {
                Db::rollBack();
                abort(500);
            }
        } else {
            return back();
        }
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
        Cart::destroyItem($product);

        return back();
    }
}
