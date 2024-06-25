<?php

namespace App\Orchid\Resources;

use App\Models\Group;
use App\Models\Product;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class GroupResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Group::class;

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
                ->placeholder('Enter title here'),
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
            TD::make('id'),
            TD::make('title'),
            TD::make('created_at', 'Date of creation')
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Update date')
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
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
            Sight::make('products')->render(
                function (Group $group) {
                    return view('components.card', [
                        'products' => $group->products
                    ]);
                }
            ),

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
