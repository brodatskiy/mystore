<?php

namespace App\Service;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

//Неиспользуемый
class ProductService
{
    /**
     * @throws Throwable
     */
    public function store($data): void
    {
        try {
            DB::beginTransaction();
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

            $tags = $data['tags'] ?? null;
            unset($data['tags']);
            $sizes = $data['sizes'];
            unset($data['sizes']);

            $product = Product::firstOrCreate([
                'title' => $data['title'],
            ], $data);

            $product->tags()->attach($tags);

            foreach ($sizes as $size) {
                /** @var Product $product */
                $product->sizes()->attach($size['id'], ['count' => $size['count']]);
            }
            Db::commit();
        } catch (Exception ) {
            Db::rollBack();
            abort(500);
        }
    }

    /**
     * @throws Throwable
     */
    public function update($data, $product)
    {
        try {
            DB::beginTransaction();
            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            } else {
                unset($data['preview_image']);
            }
            $tags = $data['tags'] ?? null;
            $tags = array_column($tags, 'id');
            unset($data['tags']);

            $sizes = $data['sizes'];
            unset($data['sizes']);

            $product->update($data);
            $product->tags()->sync($tags);


            foreach ($sizes as $size) {
                $product->sizes()->updateExistingPivot($size['id'], ['count' => $size['count']]);
            }

            Db::commit();
        } catch (Exception) {
            Db::rollBack();
            abort(500);
        }
        return $product;
    }
}
