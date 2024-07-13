<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductCardResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithCategoriesResource;
use App\Http\Resources\Section\SectionWithParentCategoriesResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Tag;
use Illuminate\Http\Client\Request;
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

        return Inertia::render('Client/Home/Index', [
            'sort' => $request->sort ?? '',
            'search' => $request->search ?? '',
            'products' => ProductCardResource::collection($products),
            'tags' => $tags,
            'price' => $request->price ?? [$minPrice, $maxPrice],
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

        // $colors = Color::all();
        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return Inertia::render('Client/Catalog/Index', [
            'sort' => $request->sort ?? '',
            'search' => $request->search ?? '',
            'products' => ProductCardResource::collection($products),
            'tags' => $tags,
            'price' => $request->price ?? [$minPrice, $maxPrice],
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

        // $colors = Color::all();
        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return Inertia::render('Client/Catalog/Index', [
            'sort' => $request->sort ?? '',
            'search' => $request->search ?? '',
            'products' => ProductCardResource::collection($products),
            'tags' => $tags,
            'price' => $request->price ?? [$minPrice, $maxPrice],
        ]);
    }

    public function navigation()
    {
        $section = Section::with('categories')->get();
        $section->load('categories');

        return SectionWithCategoriesResource::collection($section);
    }
}
