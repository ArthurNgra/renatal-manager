<?php

namespace App\Nova;

use App\Models\MaterialModel;
use App\Nova\Filters\MaterialAvailDFrom;
use App\Nova\Filters\MaterialAvailTo;
use App\Nova\Filters\MaterielType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;


class Materiel extends Resource
{
    public static $model = MaterialModel::class;

    public function title()
    {
        return $this->brand . ' ' . $this->model;
    }


    public static $search = [
        'id', 'brand', 'model', 'serial'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make('Marque', 'brand')
                ->sortable()
                ->rules('required'),
            Text::make('Modèle', 'model')
                ->sortable()
                ->rules('required'),
            Text::make('Specs')
                ->sortable()
                ->rules('nullable'),
            Text::make('N° série', 'serial')
                ->sortable()
                ->rules('required'),
            BelongsTo::make('Category', 'category', Category::class),
            Boolean::make('etat', 'has_issue'),
            Text::make('prix', 'price'),
            BelongsToMany::make('Rentals', 'rentals', Location::class),
        ];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [new MaterielType, new MaterialAvailDFrom(), new MaterialAvailTo()
        ];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [

        ];
    }

    public static function relatableQuery(NovaRequest $request, $query)
    {
        return $query->orderBy('category_id')->orderBy('brand');
    }
}
