<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function show(Product $product): Response
    {
        if (auth()->check()) {
            $wished = (bool)$product->wishedBy()->wherePivot('user_id', auth()->user()->id)->first();
        } else {
            $wished = false;
        }

        $product->wished = $wished;

        return Inertia::render('Client/Product/Index', [
            'product' => new ProductResource($product),
        ]);
    }
}
