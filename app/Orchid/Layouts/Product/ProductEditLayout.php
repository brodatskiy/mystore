<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
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
                ->required()
                ->type('text')
                ->max(255)
                ->title(__('Title'))
                ->placeholder(__('Title')),

            TextArea::make('product.description')
                ->required()
                ->title('Description')
                ->placeholder('Description'),

            Input::make('product.color')
                ->required()
                ->type('color')
                ->title('Color')
                ->value('#563d7c')
                ->horizontal(),

            Input::make('product.price')
                ->required()
                ->type('number')
                ->title(__('Price'))
                ->placeholder(__('Price')),

            Select::make('product.tags.')
                ->required()
                ->fromModel(Tag::class, 'title')
                ->multiple()
                ->title(__('Tag')),

            Select::make('product.sticker_id')
                ->fromModel(Sticker::class, 'title')
                ->empty('No select')
                ->title(__('Sticker')),

            Select::make('product.category_id')
                ->required()
                ->fromModel(Category::class, 'title')
                ->title(__('Category')),

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
