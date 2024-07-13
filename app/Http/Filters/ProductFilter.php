<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const SEARCH = 'search';
    public const CATEGORY_ID = 'category_id';
    public const PRICE = 'price';



    protected function getCallbacks(): array
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::PRICE => [$this, 'price'],
        ];
    }

    public function search(Builder $builder, $value)
    {
        $builder->where('products.' . 'title', 'like', "%{$value}%");
    }

    public function categoryId(Builder $builder, $value)
    {

        $builder->where('category_id', $value);
    }

    public function price(Builder $builder, $value)
    {
        $builder->whereBetween('price', [$value[0], $value[1]]);
    }

    public function tags(Builder $builder, $value)
    {
        //
    }
}
