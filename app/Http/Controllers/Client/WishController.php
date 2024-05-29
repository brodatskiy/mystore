<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WishController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wishlist = $user->wishes()->get() ?? collect([]);

        return Inertia::render('Client/Wishlist/Index', [
            'wishlist' => $wishlist,
        ]);
    }
}
