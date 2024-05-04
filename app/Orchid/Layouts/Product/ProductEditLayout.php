<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use App\Models\Group;
use App\Models\Sticker;
use App\Models\Tag;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class ProductEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('product.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Title'))
                ->placeholder(__('Title')),

            TextArea::make('product.description')
                ->title('Description')
                ->placeholder('Description')
                ->required(),

            Input::make('product.color')
                ->type('color')
                ->title('Color')
                ->value('#563d7c')
                ->horizontal(),

            Input::make('product.price')
                ->type('number')
                ->title(__('Price'))
                ->placeholder(__('Price')),

            Select::make('product.tags.')
                ->fromModel(Tag::class, 'title')
                ->multiple()
                ->title(__('Tag')),

            Select::make('product.sticker_id')
                ->fromModel(Sticker::class, 'title')
                ->title(__('Sticker')),

            Select::make('product.category_id')
                ->fromModel(Category::class, 'title')
                ->title(__('Category')),

            Select::make('product.group_id')
                ->fromModel(Group::class, 'title')
                ->title(__('Group')),

            CheckBox::make('product.is_published')
                ->value(1)
                ->sendTrueOrFalse()
                ->title(__('Published')),

            Button::make(__('Save'))
                ->class('btn btn-link float-end')
                ->type(Color::BASIC)
                ->icon('bs.check-circle')
                ->method('save')
        ];
    }
}
