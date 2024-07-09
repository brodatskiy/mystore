<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use App\Models\Section;
use App\Models\Sticker;
use App\Models\Tag;
use Illuminate\Database\Query\Builder;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class CategoryEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('category.title')
                ->required()
                ->type('text')
                ->max(255)
                ->title(__('Title'))
                ->placeholder(__('Title')),

            Select::make('category.section_id')
                ->required()
                ->fromModel(Section::class, 'title')
                ->title(__('Section')),

            Select::make('category.parent_id')
                ->empty('No select')
                ->fromModel(Category::class, 'title')
                ->title(__('Category')),

            Button::make(__('Save'))
                ->class('btn btn-link float-end')
                ->type(Color::BASIC)
                ->icon('bs.check-circle')
                ->method('save')
        ];
    }
}
