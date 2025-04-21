<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Components\Cells\Number;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'products';

    /**
     * @return TD[]
     * @throws \ReflectionException
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->width('120')
                ->render(fn(Product $product) => "<img src='$product->preview_image'
                      alt='preview_image'
                      class='mw-100 d-block img-fluid rounded-1 w-100'>
                    <span class='small text-muted mt-1 mb-0'># $product->id</span>")
                ->sort(),
            TD::make('title')->width(120)->sort()->filter(Input::make()),
            TD::make('description')->width(200)->defaultHidden(),
            TD::make('price')
                ->usingComponent(Currency::class, after: '₽')
                ->align(TD::ALIGN_CENTER)
                ->sort(),
            TD::make('rating')
                ->usingComponent(Number::class, decimals: 1)
                ->align(TD::ALIGN_CENTER)
                ->sort(),
            TD::make('tags', 'Tags')
                ->render(
                    function (Product $product) {
                        return view('components.chip', [
                            'tags' => $product->tags
                        ]);
                    }
                )
                ->align(TD::ALIGN_CENTER),
            TD::make('sticker_id', 'Sticker')
                ->render(
                    function (Product $product) {
                        return $product->sticker->title ?? null;
                    }
                )
                ->align(TD::ALIGN_CENTER),
            TD::make('category')
                ->render(function (Product $product) {
                    return $product->category->title;
                })
                ->align(TD::ALIGN_CENTER),

            TD::make('is_published', "Published")->usingComponent(Boolean::class)
                ->align(TD::ALIGN_CENTER)
                ->sort(),

            TD::make('created_at', 'Date of creation')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort()
                ->defaultHidden(),

            TD::make('updated_at', 'Update date')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort()
                ->defaultHidden(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(Product $product) => Group::make([
                    Link::make(__('View'))
                        ->icon('bs.eye')
                        ->route('platform.products.view', $product->id),

                    Link::make(__('Edit'))
                        ->icon('bs.pencil')
                        ->route('platform.products.edit', $product->id),

                    Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Are you sure?'))
                        ->method('remove', [
                            'id' => $product->id,
                        ]),
                ]))
        ];
    }
}
