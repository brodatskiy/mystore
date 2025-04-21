<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductCardResource;
use App\Http\Resources\Section\SectionWithCategoriesResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Tag;
use Inertia\Inertia;

class CatalogController extends Controller
{
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::query()
            ->filter($filter)
            ->sorted()
            ->paginate(8)
            ->withQueryString();

        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price ?? 0;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price ?? 1000;

        return Inertia::render('Client/Catalog/Index', [
            'sort' => $request->sort ?? 'popularity',
            'search' => $request->search ?? '',
            'products' => ProductCardResource::collection($products),
            'tags' => $tags,
            'minPrice' => $request->minPrice ? (int)$request->minPrice : $minPrice,
            'maxPrice' => $request->maxPrice ? (int)$request->maxPrice : $maxPrice,
        ]);
    }

    public function sectionIndex(FilterRequest $request, Section $section)
    {
        $data = $request->validated();

        $products = $section->products();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = $products
            ->filter($filter)
            ->sorted()
            ->paginate(8)
            ->withQueryString();

        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return Inertia::render('Client/Catalog/Index', [
            'sort' => $request->sort ?? '',
            'search' => $request->search ?? '',
            'products' => ProductCardResource::collection($products),
            'tags' => $tags,
            'minPrice' => $request->minPrice ?? $minPrice,
            'maxPrice' => $request->maxPrice ?? $maxPrice,
        ]);
    }

    public function categoryIndex(FilterRequest $request, Section $section, Category $category)
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = $category->products()
            ->filter($filter)
            ->sorted()
            ->paginate(8)
            ->withQueryString();

        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return Inertia::render('Client/Catalog/Index', [
            'sort' => $request->sort ?? '',
            'search' => $request->search ?? '',
            'products' => ProductCardResource::collection($products),
            'tags' => $tags,
            'minPrice' => $request->minPrice ?? $minPrice,
            'maxPrice' => $request->maxPrice ?? $maxPrice,
        ]);
    }

    public function navigation()
    {
        $section = Section::with('categories')->get();

        return SectionWithCategoriesResource::collection($section);
    }
}
