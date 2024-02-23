<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Inertia\Inertia;
use App\Http\Controllers\MainController;
use App\Http\Resources\Product\ProductResource;
use App\Models\Group;
use App\Models\Size;

class ProductController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Admin/Products/Index', [
            'products' => ProductResource::collection($products)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();
        $categories = Category::all();
        $tags = Tag::all();
        $sizes = Size::all();

        return Inertia::render('Admin/Products/Create', [
            'groups' => $groups,
            'categories' => $categories,
            'tags' => $tags,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);

        return to_route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Admin/Products/Show', [
            'product' => new ProductResource($product),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $groups = Group::all();
        $categories = Category::all();
        $tags = Tag::all();

        return Inertia::render('Admin/Products/Edit', [
            'product' => new ProductResource($product),
            'groups' => $groups,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product = $this->service->update($data, $product);

        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index');
    }
}
