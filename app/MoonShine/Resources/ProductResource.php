<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Product';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('name')->sortable(),
            Text::make('description')->sortable(),
            Text::make('price')->sortable(),
            Text::make('sale_price')->sortable(),
            BelongsTo::make(
                'Category ID and Name',
                'category',
                fn($item)=>"$item->name",
                CategoryResource::class),
            BelongsTo::make(
                'Product volume',
                'volume',
                fn($item)=>"$item->name",
                VolumeResource::class),
            Text::make('stock_quantity')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Name'),
                Text::make('Description'),
                Text::make('Price'),
                Text::make('Sale price'),
                BelongsTo::make(
                    'Category ID and Name',
                    'category',
                    fn($item)=>"$item->id. $item->name",
                    CategoryResource::class)->nullable(),
                BelongsTo::make(
                    'Product volume',
                    'volume',
                    fn($item)=>"$item->id. $item->name",
                    VolumeResource::class)->nullable(),
                Text::make('Stock quantity'),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name'),
            Text::make('Description'),
            Text::make('Price'),
            Text::make('Sale price'),
            BelongsTo::make(
                'Category ID and Name',
                'category',
                fn($item)=>"$item->id. $item->name",
                CategoryResource::class),
            BelongsTo::make(
                'Product volume',
                'volume',
                fn($item)=>"$item->id. $item->name",
                VolumeResource::class),
            Text::make('Stock quantity'),
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [

        ];
    }
}
