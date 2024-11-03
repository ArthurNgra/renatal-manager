<?php

namespace App\Nova;

use App\Models\Package as PackageModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Package extends Resource
{
    public static $model = PackageModel::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make('Nom','name')
                ->sortable()
                ->rules('required'),
            BelongsToMany::make('materiel', 'packageItems', ElementDePackage::class),

            BelongsTo::make('Réduction','reduction',Reductions::class)
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
