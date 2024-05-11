<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CatalogController extends Controller
{
    public function __invoke(FilterRequest $request, Category $category)
    {
        $data = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $products = ProductResource::collection($category->products()->filter($filter)->paginate(8)->withQueryString());
        $categories = Category::all();
        // $colors = Color::all();
        $tags = Tag::all();

        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return Inertia::render('Client/Home/Index', [
            'products' => $products,
            'categories' => $categories,
            'tags' => $tags,
            'price' => [$minPrice, $maxPrice],
        ]);
    }
}
