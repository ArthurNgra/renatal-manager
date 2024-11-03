<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use App\Models\Reduction as ReductionModel;
use Laravel\Nova\Fields\Select;

class Reductions extends Resource
{
    public static $model = ReductionModel::class;

    public function title()
    {
        $type=$this->type=='V'?'€':'%';
        return $this->name.'  -  '.$this->valeur.' '.$type;
    }

    public static $search = [
        'id', 'type'
    ];

    public function fields(Request $request): array
    {
        return [

            \Laravel\Nova\Fields\Text::make('Nom', 'name'),
            Select::make('Type')
                ->options(['%' => 'Pourcentage',
                    '€' => 'valeur'])
                ->sortable()
                ->help('V une somme, P en %')
                ->rules('required'),
            Number::make('Valeur', 'valeur')
                ->sortable()
                ->rules('required', 'integer'),

        ];
//
//        ];
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
