<?php

namespace App\Nova;

use App\Models\Prestation as PrestationModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Prestation extends Resource
{
    public static $model = PrestationModel::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'description'
    ];

    public function fields(Request $request): array
    {
        return [

            Text::make('Nom','name')
                ->sortable()
                ->rules('required'),

            Text::make('Description','description')
                ->sortable()
                ->rules('required'),

            Number::make('Prix','price')
                ->sortable()
                ->rules('required', 'numeric'),
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
