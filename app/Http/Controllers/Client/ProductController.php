<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return Inertia::render('Client/Product/Index', [
            'product' => new ProductResource($product),
        ]);
    }
}
