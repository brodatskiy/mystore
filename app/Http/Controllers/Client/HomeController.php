<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::query()
            ->filter($filter)
            ->sorted()
            ->paginate(8)
            ->withQueryString();

        // $colors = Color::all();
        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return Inertia::render('Client/Home/Index', [
            'sort' => $request->sort ?? '',
            'search' => $request->search ?? '',
            'products' => ProductResource::collection($products),
            'tags' => $tags,
            'price' => $request->price ?? [$minPrice, $maxPrice],
        ]);
    }
}
