<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductCropperLayout;
use App\Orchid\Layouts\Product\ProductEditLayout;
use App\Orchid\Service\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductEditScreen extends Screen
{
    /**
     * @var Product
     * @noinspection PhpMissingFieldTypeInspection
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
            'platform.products',
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
     * @param Product $product
     * @param Request $request
     * @param ProductService $productService
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function save( Request $request, Product $product, ProductService $productService): RedirectResponse
    {
        $productService->save($product, $request);

        Toast::info(__('Product was saved'));

        return redirect()->route('platform.products.view', $product);
    }

    /**
     * @param Product $product
     * @param ProductService $productService
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function remove(Product $product, ProductService $productService): RedirectResponse
    {
        $productService->delete($product);

        Toast::info(__('Product was removed'));

        return redirect()->route('platform.products');
    }
}
