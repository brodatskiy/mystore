<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductListLayout;
use App\Orchid\Service\ProductService;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ProductListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::filters()->defaultSort('id', 'desc')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Product Management';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'A list of all products.';
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
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->route('platform.products.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            ProductListLayout::class,
        ];
    }

    /**
     * @throws \Throwable
     */
    public function remove(Request $request, ProductService $productService): void
    {
        $productService->delete(Product::findOrFail($request->get('id')));

        Toast::info(__('Product was removed'));
    }
}
