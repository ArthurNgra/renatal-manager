<?php

namespace App\Nova;

use App\Models\Devis as DevisModel;
use App\Nova\Actions\EnvoyerDevis;
use App\Nova\Metrics\DevisTotal;
use App\Nova\Metrics\DevisTotalAprèsReduction;
use App\Nova\Metrics\TotalTtc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;

class Devis extends Resource
{
    public static $model = DevisModel::class;

    public function title()
    {
        return $this->getClient()->firstname . ' ' . $this->getClient()->lastname . ' / ' . $this->rental->address . ' / ' . Carbon::parse($this->rental->from)->toDateString() . '-' . Carbon::parse($this->to)->toDateString();

    }


    public static $search = [
        'id'
    ];

    public function fields(Request $request): array
    {
        return [
            Select::make('Status')->options(['creer' => 'creer', 'en cours' => 'en cours', 'valider' => 'valider', 'refuser' => 'refuser'])->onlyOnDetail(),
            Status::make('Status')
                ->loadingWhen(['en cours', 'creer'])
                ->failedWhen(['refuser']),

            BelongsTo::make('Location', 'rental', Location::class),
            BelongsToMany::make('Prestation', 'prestations', Prestation::class),
            BelongsToMany::make('Reductions', 'reductions', Reductions::class),
            HasMany::make('Facture', 'factures', Facture::class),
            BelongsToMany::make('Materiels', 'materialsForNova', Materiel::class),
            File::make('PDF','downloadurl')->disk('local')->displayUsing(function () {
                return 'Télécharger le fichier';
            })->hideFromIndex(),
            ];

    }

    public function cards(Request $request): array
    {
        return [
            (new DevisTotal($request->resourceId))->onlyOnDetail(),
            (new DevisTotalAprèsReduction($request->resourceId))->onlyOnDetail(),
           ( new TotalTtc($request->resourceId)),
        ];
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
        return [
            new EnvoyerDevis
        ];
    }
}
