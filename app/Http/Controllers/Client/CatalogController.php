<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CatalogController extends Controller
{
    public function show()
    {
        $products = Product::all();
        return Inertia::render('Client/Catalog/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }
}
