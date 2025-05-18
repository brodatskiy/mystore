<?php

namespace App\Service;

use App\Http\Filters\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Tag;
use Illuminate\Contracts\Container\BindingResolutionException;

class CatalogService
{
    /**
     * @throws BindingResolutionException
     */
    public function getCatalog(array $data, ?Section $section = null, ?Category $category = null): array
    {
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        if ($section && $category) {
            $products = $category->products();
        } elseif ($section) {
            $products = $section->products();
        } else {
            $products = Product::query();
        }

        $products = $products
            ->filter($filter)
            ->sorted()
            ->paginate(8)
            ->withQueryString();

        $tags = Tag::all();
        $minPrice = Product::orderBy('price', 'ASC')->first()->price;
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;

        return [$products, $tags, $minPrice, $maxPrice];
    }
}
