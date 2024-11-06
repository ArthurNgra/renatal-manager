<?php

namespace App\Nova;

use App\Models\InvoiceSpec;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class CaracteristiqueFacture extends Resource
{
    public static $model = InvoiceSpec::class;

    public static $title = 'type';

    public static $search = [
        'id', 'tva', 'type'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Tva')
                ->sortable()
                ->rules('required'),

            Text::make('Type')
                ->sortable()
                ->rules('required'),

            HasMany::make('clients')
        ];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [];
    }
}
