<?php

namespace App\Orchid\Service;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Toast;

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
            $product->tags()->sync($request->input('product.tags'));
            Toast::info(__('Product was saved.'));
            Db::commit();
        } catch (Exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
