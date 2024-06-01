<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
        $wishlist = $user?->wishes()->get() ?? collect([]);
        $wishlist = Wish::where('user_id', auth()->id())->with('product')->get();

        $wishlist = WishResource::collection($wishlist);
        // dd($wishlist);
        return Inertia::render('Client/Wishlist/Index', [
            'wishlist' => $wishlist,
        ]);
    }

    public function add(Product $product): RedirectResponse
    {

        $user = auth()->user();
        $user->wishes()->toggle([$product->id]);

        return back();
    }
}
