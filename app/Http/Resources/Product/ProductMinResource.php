<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Sticker\StickerResource;
use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductMinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
            'group' => $this->group_id,
            'category' => new CategoryResource($this->category),
            'sticker' => new StickerResource($this->sticker),
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
