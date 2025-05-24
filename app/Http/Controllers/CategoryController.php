<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        return Cache::flexible('categories', [600, 1200], function () {
            $category = Category::all();

            return CategoryResource::collection($category);
        });
    }
}
