<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const string SEARCH = 'search';
    public const string MIN_PRICE = 'minPrice';
    public const string MAX_PRICE = 'maxPrice';

    protected function getCallbacks(): array
    {
        return [
            self::SEARCH => [$this, 'search'],
            self::MIN_PRICE => [$this, 'minPrice'],
            self::MAX_PRICE => [$this, 'maxPrice'],
        ];
    }

    public function search(Builder $builder, $value): void
    {
        $builder->where('products.' . 'title', 'like', "%{$value}%");
    }

    public function minPrice(Builder $builder, $value): void
    {
        $builder->where('price', '>', $value);
    }

    public function maxPrice(Builder $builder, $value): void
    {
        $builder->where('price', '<', $value);
    }
}
