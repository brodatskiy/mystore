<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::query()->paginate(8);
        $products = ProductResource::collection($products);
        return Inertia::render('Client/Home/Index', [
            'products' => $products,
        ]);
    }
}
