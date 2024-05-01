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
                ->render(fn ($model) =>
                "<img src='$model->imageUrl'
                      alt='preview_image'
                      class='mw-100 d-block img-fluid rounded-1 w-100'>
                    <span class='small text-muted mt-1 mb-0'># {$model->id}</span>")
                ->sort(),
            TD::make('title')->sort(),
            TD::make('description')->width(200)->defaultHidden(),
            TD::make('color')
                ->render(fn ($model) => "<div class='rounded' style='height:16px; width:16px; background:{$model->color}'></div>")
                ->align(TD::ALIGN_CENTER),
            TD::make('price')
                ->usingComponent(Currency::class, after: '₽')
                ->align(TD::ALIGN_CENTER)
                ->sort(),
            TD::make('tags', 'Tags')
                ->render(
                    function ($model) {
                        return view('components.chip', [
                            'tags' => $model->tags
                        ]);
                    }
                )
                ->align(TD::ALIGN_CENTER),
            TD::make('sticker', 'Sticker')
                ->defaultHidden()
                ->render(
                    function ($model) {
                        return $model->sticker->title;
                    }
                )
                ->align(TD::ALIGN_CENTER),
            TD::make('category')
                ->render(function ($model) {
                    return $model->category->title;
                })
                ->align(TD::ALIGN_CENTER),
            TD::make('group_id', "Group")
                ->render(function ($model) {
                    return $model->group->title;
                })
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
        ];
    }
}
