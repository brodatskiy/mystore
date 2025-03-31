<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Sticker\StickerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if (auth()->check()) {
            $wished = $this->wishedBy()->wherePivot('user_id', auth()->user()->id)->first() ? true : false;
        } else {
            $wished = false;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->preview_image,
            'wished' => $wished,
            'color' => $this->color,
            'price' => $this->price,
            'is_published' => $this->is_published,
            'category' => new CategoryResource($this->category),
            'sticker' => new StickerResource($this->sticker),
            'tags' => TagResource::collection($this->tags),
        ];
    }
}
