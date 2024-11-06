<?php

namespace App\Nova;

use App\Models\RentalModel;
use App\Nova\Actions\Pack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Location extends Resource
{
    public static $model = RentalModel::class;


    public function title()
    {
        return $this->client->firstname . ' ' . $this->client->lastname . ' / ' . $this->address . ' / ' . Carbon::parse($this->from)->toDateString() . '-' . Carbon::parse($this->to)->toDateString();

    }

    public static $search = [
        'id', 'address'
    ];

    public function fields(Request $request): array
    {
        $from = $this->from ?? now();
        $to = $this->to ?? now();

        // Get the available materials based on the specified date range


        return [

            Text::make('Tel contact', 'referal_phone')
                ->sortable()
                ->rules('nullable'),

            Text::make('Adresse', 'address')
                ->sortable()
                ->rules('required'),

            Date::make('Du', 'from')
                ->sortable()
                ->rules('required', 'date'),

            Date::make('Au', 'to')
                ->sortable()
                ->rules('required', 'date'),

            Text::make('Demandes spéciales', 'special_demands')
                ->sortable()
                ->rules('nullable'),

            BelongsTo::make('Client', 'client', Client::class),
            BelongsToMany::make('Materials', 'materials', Materiel::class),
//           BelongsToMany::make('Materials', 'm', FilterMaterial::class),
            HasMany::make('Devis', 'devis', Devis::class),

        ];
    }


    public function cards(Request $request): array
    {
        return [

        ];
    }

    public function filters(Request $request): array
    {
        return [
        ];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [
            new Pack()


        ];
    }

    public static function relatableMaterialModels(NovaRequest $request, $query)
    {
        // Ensure that the rental is valid
        $rental = RentalModel::find($request->resourceId);
        if (!$rental) {
            return $query; // Return the default query if no rental found
        }

        $from = Carbon::parse($rental->from);
        $to = Carbon::parse($rental->to);
       return $query->whereDoesntHave('rentals', function ($queryTime) use ($from, $to) {
            $queryTime->where(function ($overlapQuery) use ($from, $to) {
                $overlapQuery->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from, $to])
                    ->orWhere(function ($query) use ($from, $to) {
                        $query->where('from', '<=', $from)
                            ->where('to', '>=', $to);
                    });
            });
        });
    }

}
