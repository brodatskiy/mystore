<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Product\ProductMinResource;
use App\Http\Resources\Sticker\StickerResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->preview_image,
            'color' => $this->color,
            'price' => $this->price,
            'is_published' => $this->is_published,
            'category' => new CategoryResource($this->category),
            'sticker' => new StickerResource($this->sticker),
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
