<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Components\Cells\Number;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductViewScreen extends Screen
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
            Link::make(__('Edit'))
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
     * @throws \ReflectionException
     */
    public function layout(): iterable
    {
        return [
            Layout::split([
                Layout::legend('product', [
                    Sight::make('preview_image', 'Preview image')
                        ->render(fn(Product $product) => "<img src='$product->preview_image'
                          alt='preview_image'
                          class='mw-100 d-block img-fluid rounded-1 w-100'>")
                ]),

                Layout::legend('product', [
                    Sight::make('id'),
                    Sight::make('title'),
                    Sight::make('description'),
                    Sight::make('price')
                        ->usingComponent(Currency::class, after: '₽'),
                    Sight::make('rating')
                        ->usingComponent(Number::class, decimals: 1),
                    Sight::make('tags')->render(
                        function (Product $product) {
                            return view('components.chip', [
                                'tags' => $product->tags
                            ]);
                        }
                    ),
                    Sight::make('sticker_id', 'Sticker')->render(
                        function (Product $product) {
                            return $product->sticker->title ?? null;
                        }
                    ),
                    Sight::make('category_id', 'Category')->render(function (Product $product) {
                        return $product->category->title;
                    }),
                    Sight::make('is_published', "Published")->usingComponent(Boolean::class),
                    Sight::make('created_at', "Date of creation")->usingComponent(DateTimeSplit::class),
                    Sight::make('updated_at', "Update date")->usingComponent(DateTimeSplit::class),
                ]),
            ])->ratio('40/60'),

        ];
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function remove(Product $product): RedirectResponse
    {
        $product->delete();

        Toast::info(__('Product was removed'));

        return redirect()->route('platform.products');
    }
}
