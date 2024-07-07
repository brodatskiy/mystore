<?php

namespace App\Orchid\Resources;

use App\Models\Category;
use App\Models\Section;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class CategoryResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Category::class;

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
            Select::make('section_id')
                ->required()
                ->fromModel(Section::class, 'title')
                ->title(__('Section')),
            Select::make('category_id')
                ->fromModel(Category::class, 'title')
                ->empty('No select')
                ->title(__('Parent category')),
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
            TD::make('title', 'Title'),
            TD::make('section_id', 'Section')
                ->render(
                    function (Category $category) {
                        return $category->section->title ?? null;
                    }
                )
                ->align(TD::ALIGN_CENTER),
            TD::make('category_id', 'Parent category')
                ->render(
                    function (Category $category) {
                        return $category->parent->title ?? null;
                    }
                )
                ->align(TD::ALIGN_CENTER),
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
            Select::make('product.section_id')
                ->required()
                ->fromModel(Section::class, 'title')
                ->title(__('Section')),
            Select::make('product.category_id')
                ->fromModel(Category::class, 'title')
                ->title(__('Category')),
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
