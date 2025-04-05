<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCardResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Wish\WishResource;
use App\Models\Product;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WishController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = $user->wishes()->get() ?? collect([]);

        foreach ($products as $product) {
            if (auth()->check()) {
                $wished = (bool)$product->wishedBy()->wherePivot('user_id', auth()->user()->id)->first();
            } else {
                $wished = false;
            }

            $product->wished = $wished;
        }

        return Inertia::render('Client/Wishlist/Index', [
            'wishlist' => ProductResource::collection($products),
        ]);
    }

    public function toggle(Product $product): RedirectResponse
    {

        $user = auth()->user();
        $user->wishes()->toggle([$product->id]);

        return back();
    }
}
