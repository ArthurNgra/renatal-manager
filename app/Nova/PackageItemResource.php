<?php

namespace App\Nova;

use App\Models\MaterialModel;
use App\Models\PackageItem;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;

class PackageItemResource extends Resource
{
    public static $model = PackageItem::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request): array
    {
        // Fetch model names from MaterialModel
        $modelNames = MaterialModel::all()->pluck('model')->unique()->mapWithKeys(function ($item) {
            return [$item => $item];
        });
        return [
            ID::make()->sortable(),

            Select::make('name')
//                ->options($modelNames)
                ->options($modelNames)

                ->sortable()
                ->rules('required'),

            Number::make('Quantity')
                ->sortable()
                ->rules('required', 'integer'),

            BelongsToMany::make('Pack', 'packages', PackageResource::class),
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
