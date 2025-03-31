<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Sticker\StickerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCardResource extends JsonResource
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
            'image' => $this->preview_image,
            'wished' => $wished,
            'price' => $this->price,
            'sticker' => new StickerResource($this->sticker),
        ];
    }
}
