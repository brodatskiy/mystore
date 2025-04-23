<?php

namespace App\Http\Resources\Section;

use App\Http\Resources\Category\CategoryWithChildrenResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $slug
 * @method parentCategories()
 */
class SectionWithCategoriesResource extends JsonResource
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
            'slug' => $this->slug,
            'parentCategories' => CategoryWithChildrenResource::collection($this->categories->load('children')),
        ];
    }
}
