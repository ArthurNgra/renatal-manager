<?php

namespace App\Nova;

use App\Models\ClientModel;
use App\Models\Facture as ModelsFacture;
use App\Nova\Actions\ValiderFacture;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;

class Facture extends Resource
{
    public static $model = ModelsFacture::class;

    public static $title = 'id';

    public static $search = [
        'id', 'status'
    ];

    public function fields(Request $request): array
    {

        return [
            ID::make()->sortable(),


            Select::make('Status')->options([
                'Ouverte' => 'Ouverte',
                'Payé' => 'Payé',
                'Retard' => 'Retard',
                'Impayé' => 'Impayé'
            ])
                ->hideWhenCreating()
                ->required(),

            Status::make('status')
                ->loadingWhen(['Ouverte'])
                ->failedWhen(['Retard',
                    'Impayé'])
                ->sortable(),

            Date::make('Due Date')
                ->sortable()
                ->rules('required', 'date'),

            Number::make('Total', function () {
                return $this->getTotal();
            })->onlyOnDetail(),

            Number::make('Total', function () {
                return $this->getTotalWithReduction();
            })->onlyOnDetail(),
            BelongsTo::make('Devis', 'devis', Devis::class),
            Text::make('Client', function () {
                $client = ClientModel::find($this->client_id);
                $url = '/resources/clients/' . $client->id;
                $html = '<a class="link-default" href="' . $url . '">' . htmlspecialchars($client->firstname) . '</a>';

                return $html;
            })->asHtml()->onlyOnDetail(),

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
        return [new ValiderFacture];
    }
}
