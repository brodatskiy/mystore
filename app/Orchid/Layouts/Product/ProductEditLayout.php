<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use App\Models\Sticker;
use App\Models\Tag;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
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

            Input::make('product.price')
                ->required()
                ->type('number')
                ->title(__('Price'))
                ->placeholder(__('Price')),

            Input::make('product.rating')
                ->value(5)
                ->required()
                ->mask([
                    'mask' => '9.9',
                    'numericInput' => true
                ])
                ->title(__('Rating'))
                ->placeholder(__('Rating')),

            Input::make('product.count')
                ->value(100)
                ->required()
                ->type('number')
                ->title(__('Count'))
                ->placeholder(__('Count')),

            Select::make('product.tags.')
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
