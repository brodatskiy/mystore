<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Main/Index', [
            'products' => ProductResource::collection($products),
        ]);
    }
}
