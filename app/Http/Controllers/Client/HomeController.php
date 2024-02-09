<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Client/Home/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }
}
