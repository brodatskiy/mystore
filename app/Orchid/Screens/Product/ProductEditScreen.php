<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductCropperLayout;
use App\Orchid\Layouts\Product\ProductEditLayout;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductEditScreen extends Screen
{
    /**
     * @var Product
     */
    public $product;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {

        return [
            'product' => $product,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Edit Product' : 'Create Product';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Product page.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.products',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->product->exists),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::split([
                ProductCropperLayout::class,
                ProductEditLayout::class,
            ])->ratio('40/60'),
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function save(Product $product, Request $request)
    {
        try {
            DB::beginTransaction();
            $product->fill($request->collect('product')->except(['tags'])->toArray())->save();
            $product->tags()->sync($request->input('product.tags'));
            Toast::info(__('Product was saved.'));
            Db::commit();
            return redirect()->route('platform.products');
        } catch (Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
    }

    /**
     * @throws Exception
     *
     * @return RedirectResponse
     */
    public function remove(Product $product)
    {
        $product->delete();

        Toast::info(__('Product was removed'));

        return redirect()->route('platform.products');
    }
}
