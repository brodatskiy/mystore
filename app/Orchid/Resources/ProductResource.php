<?php

namespace App\Orchid\Resources;

use App\Models\Category;
use App\Models\Group;
use App\Models\Sticker;
use App\Models\Tag;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Components\Cells\Boolean;
use Orchid\Screen\Components\Cells\Currency;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class ProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('title')
                ->title('Title')
                ->placeholder('Title')
                ->required(),

            TextArea::make('description')
                ->title('Description')
                ->placeholder('Description')
                ->required(),

            Cropper::make('preview_image'),

            Input::make('color')
                ->type('color')
                ->title('Color')
                ->placeholder('Color')
                ->required(),

            Input::make('price')
                ->type('number')
                ->title('Price')
                ->placeholder('Price')
                ->required(),

        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
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

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('title'),

            Sight::make('created_at', 'Date of creation')->render(function ($model) {
                return $model->created_at->toDateTimeString();
            }),

            Sight::make('updated_at', 'Update date')->render(function ($model) {
                return $model->updated_at->toDateTimeString();
            }),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            new DefaultSorted('id', 'desc'),
        ];
    }

    public static function perPage(): int
    {
        return 30;
    }
}
