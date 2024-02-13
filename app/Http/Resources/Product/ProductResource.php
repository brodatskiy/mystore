<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Product\ProductMinResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $products = Product::where('group_id', $this->group_id)->get();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'image' => $this->imageUrl,
            'price' => $this->price,
            'count' => $this->count,
            'isPublished' => $this->is_published,
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'group' => ProductMinResource::collection($products)
        ];
    }
}
