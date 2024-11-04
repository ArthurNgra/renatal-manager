<?php

namespace App\Nova;

use App\Models\Company as CompanyModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Company extends Resource
{
    public static $model = CompanyModel::class;

   public function title()
   {
       return $this->name;
   }

    public static $search = [
        'id', 'adresse', 'town', 'country', 'phone', 'mail', 'siret'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make('Nom', 'name'),
            Text::make('Adresse')
                ->sortable()
                ->rules('required'),

            Text::make('Ville','town')
                ->sortable()
                ->rules('required'),

            Text::make('Pays','country')
                ->sortable()
                ->rules('required'),

            Text::make('Tel','phone')
                ->sortable()
                ->rules('required'),

            Text::make('@','mail')
                ->sortable()
                ->rules('required'),

            Text::make('Siret')
                ->sortable()
                ->rules('required'),
            Text::make('Rib','rib')->onlyOnDetail(),
            HasMany::make('Utilisateurs', 'users', 'App\Nova\Utilisateur')
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
