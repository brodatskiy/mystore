<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCardResource;
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
        $wishlist = $user->wishes()->get() ?? collect([]);

        return Inertia::render('Client/Wishlist/Index', [
            'wishlist' => ProductCardResource::collection($wishlist),
        ]);
    }

    public function toggle(Product $product): RedirectResponse
    {

        $user = auth()->user();
        $user->wishes()->toggle([$product->id]);

        return back();
    }
}
