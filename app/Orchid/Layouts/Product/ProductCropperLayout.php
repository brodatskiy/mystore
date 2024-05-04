<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Category;
use App\Models\Group;
use App\Models\Sticker;
use App\Models\Tag;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class ProductCropperLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Cropper::make('product.preview_image')
                ->required()
                ->width(300)
                ->height(500)
                ->targetRelativeUrl(),
        ];
    }
}
