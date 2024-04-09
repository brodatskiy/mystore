<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $products = Product::filter($filter)->paginate(8)->withQueryString();
        $products = ProductResource::collection($products);

        return Inertia::render('Client/Home/Index', [
            'products' => $products,
        ]);
    }
}
