<?php

namespace App\Orchid\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;
use Orchid\Attachment\Models\Attachment;

class ImagePreview extends Component
{
    private Product $product;

    /**
     * Create a new component instance.
     *
     * @param Product $product
     */

    public function __construct(Product $product)
    {
        $this->product = $product;

    }

    /**
     * Get the view/contents that represent the component.
     *
     */
    public function render(): View|Htmlable|Closure|string
    {
        return Blade::render('<img src="{{ $url }}"
                          alt="{{ $alt }}"
                          class="mw-100 d-block img-fluid rounded-1 w-100">', [
            'alt' => $this->getImage() ? $this->getImage()->alt : '',
            'url' => $this->getImageUrl() ? $this->getImage()->url : '',
        ]);
    }

    public function getImage() : Attachment
    {
        return $this->product->previewImage()->first();
    }

    public function getImageUrl()
    {
        return $this->getImage()?->getRelativeUrlAttribute();
    }
}
