<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductCropperLayout;
use App\Orchid\Layouts\Product\ProductEditLayout;
use App\Orchid\Layouts\Product\ProductViewLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductViewScreen extends Screen
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
        return 'Product info';
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
            Button::make(__('Edit'))
                ->icon('bs.pencil')
                ->route('platform.products.edit', $this->product->id),


            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->product->exists),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::split([
                Layout::legend('product', [
                    Sight::make('preview_image', 'Preview image')
                        ->render(fn (Product $product) =>
                        "<img src='$product->preview_image'
                          alt='preview_image'
                          class='mw-100 d-block img-fluid rounded-1 w-100'>")
                ]),

                Layout::legend('product', [
                    Sight::make('id'),
                    Sight::make('title'),
                    Sight::make('description'),
                    Sight::make('color')
                        ->render(fn (Product $product) => "<div class='rounded' style='height:16px; width:16px; background:{$product->color}'></div>"),
                    Sight::make('price')
                        ->usingComponent(Currency::class, after: '₽'),

                    Sight::make('tags')->render(
                        function (Product $product) {
                            return view('components.chip', [
                                'tags' => $product->tags
                            ]);
                        }
                    ),
                    Sight::make('sticker_id', 'Sticker')->render(
                        function (Product $product) {
                            return $product->sticker->title;
                        }
                    ),
                    Sight::make('category_id', 'Category')->render(function (Product $product) {
                        return $product->category->title;
                    }),
                    Sight::make('is_published', "Publised")->usingComponent(Boolean::class),
                    Sight::make('created_at', "Date of creation")->usingComponent(DateTimeSplit::class),
                    Sight::make('updated_at', "Update date")->usingComponent(DateTimeSplit::class),
                ]),
            ])->ratio('40/60'),

        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
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
        } catch (\Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Product $product)
    {
        $product->delete();

        Toast::info(__('Product was removed'));

        return redirect()->route('platform.products');
    }
}
