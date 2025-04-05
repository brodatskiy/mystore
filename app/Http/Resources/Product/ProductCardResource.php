<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Sticker\StickerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->preview_image,
            'wished' => $this->when($this->wishedBy()->wherePivot('user_id', auth()->user()?->id)->first(), 'true'),
            'price' => $this->price,
            'sticker' => new StickerResource($this->sticker),
        ];
    }
}
