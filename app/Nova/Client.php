<?php

namespace App\Nova;

use App\Models\ClientModel;
use App\Nova\Metrics\NbClient;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use function sprintf;

class Client extends Resource
{
    public static $model = ClientModel::class;

    public function title()
    {
        return $this->firstname.' '.$this->lastname;
    }


    public static $search = [
        'id', 'firstname', 'lastname', 'phone', 'mail', 'address','society'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make('Entreprise','society')
                ->placeholder('Entreprise')
                ->sortable()
                ->rules('nullable'),

            Text::make('Prenom','firstname')
                ->placeholder('Prenom')
                ->sortable()
                ->rules('required'),

            Text::make('Nom','lastname')
                ->placeholder('Nom')
                ->sortable()
                ->rules('required'),

            Text::make('Tel','phone')
                ->placeholder('Tel')
                ->sortable()
                ->rules('required'),

            Text::make('@','mail')
                ->sortable()
                ->rules('required','email'),

            Text::make('Address')
                ->sortable()
                ->rules('required'),

            Text::make('Siret')
                ->sortable()
                ->rules('nullable'),
            HasMany::make('Rentals','rentals',Location::class),
            HasMany::make('Factures','factures',Facture::class)->onlyOnDetail(),
        ];
    }

    public function cards(Request $request): array
    {
        return [ new NbClient()];
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
