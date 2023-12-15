<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

            $tags = $data['tags'] ?? null;

            unset($data['tags']);

            $product = Product::firstOrCreate([
                'title' => $data['title'],
            ], $data);

            $product->tags()->attach($tags);
            Db::commit();
        } catch (\Exception $exeption) {
            Db::rollBack();
            abort(500);
        }
    }

    public function update($data, $product)
    {
        try {
            DB::beginTransaction();
            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            $tags = $data['tags'];

            unset($data['tags']);

            $product->update($data);
            $product->tags()->sync($tags);
            Db::commit();
        } catch (\Exception $exeption) {
            Db::rollBack();
            abort(500);
        }
        return $product;
    }
}
