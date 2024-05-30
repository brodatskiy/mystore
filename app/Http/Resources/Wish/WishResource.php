<?php

namespace App\Http\Resources\Wish;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Product\ProductMinResource;
use App\Http\Resources\Sticker\StickerResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product->id,
            'title' => $this->product->title,
            'image' => $this->product->preview_image,
            'price' => $this->product->price,
            'sticker' => new StickerResource($this->product->sticker),
        ];
    }
}
