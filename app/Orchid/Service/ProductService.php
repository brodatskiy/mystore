<?php

namespace App\Orchid\Service;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * @throws \Throwable
     */
    public function save(Product $product, Request $request): void
    {
        try {
            DB::beginTransaction();
            $product->fill($request->collect('product')->except(['tags'])->toArray())->save();
            $product->attachments()->syncWithoutDetaching(
                $request->input('product.preview_image', [])
            );
            $product->tags()->sync($request->input('product.tags'));
            Db::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @throws \Throwable
     */
    public function delete(Product $product): void
    {
        try {
            DB::beginTransaction();
            $product->previewImage->delete();
            $product->delete();
            Db::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
