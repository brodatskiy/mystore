<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Layouts\Persona;
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
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->width('120')
                ->render(fn (Product $product) =>
                "<img src='$product->preview_image'
                      alt='preview_image'
                      class='mw-100 d-block img-fluid rounded-1 w-100'>
                    <span class='small text-muted mt-1 mb-0'># {$product->id}</span>")

                ->sort(),
            TD::make('title')->sort()->filter(Input::make()),
            TD::make('description')->width(200)->defaultHidden(),
            TD::make('color')
                ->render(fn (Product $product) => "<div class='rounded' style='height:16px; width:16px; background:{$product->color}'></div>")
                ->align(TD::ALIGN_CENTER),
            TD::make('price')
                ->usingComponent(Currency::class, after: '₽')
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
            TD::make('sticker', 'Sticker')
                ->defaultHidden()
                ->render(
                    function (Product $product) {
                        return $product->sticker->title;
                    }
                )
                ->align(TD::ALIGN_CENTER),
            TD::make('category')
                ->render(function (Product $product) {
                    return $product->category->title;
                })
                ->align(TD::ALIGN_CENTER),

            TD::make('group_id', "Group")
                ->render(fn (Product $product) => Link::make(__($product->group->title))
                    ->route('platform.resource.view', ['group-resources', $product->group->id]))

                ->align(TD::ALIGN_CENTER),

            TD::make('is_published', "Publised")->usingComponent(Boolean::class)
                ->align(TD::ALIGN_CENTER)
                ->sort(),

            TD::make('created_at', 'Date of creation')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('updated_at', 'Update date')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Product $product) => Group::make([
                    Link::make(__('View'))
                        ->icon('bs.eye')
                        ->route('platform.products.view', $product->id),

                    Link::make(__('Edit'))
                        ->icon('bs.pencil')
                        ->route('platform.products.edit', $product->id),

                    Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted.'))
                        ->method('remove', [
                            'id' => $product->id,
                        ]),
                ]))
        ];
    }
}
