<?php

namespace App\Nova;

use App\Models\MaterialModel;
use App\Models\RentalModel;
use App\Nova\Actions\Pack;
use App\Nova\Filters\DateFiltreMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use function Laravel\Prompts\confirm;

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

            Text::make('Referal Phone')
                ->sortable()
                ->rules('nullable'),

            Text::make('Address')
                ->sortable()
                ->rules('required'),

            Date::make('From')
                ->sortable()
                ->rules('required', 'date'),

            Date::make('To')
                ->sortable()
                ->rules('required', 'date'),

            Text::make('Special Demands')
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

        // Define the start and end of the rental period
        $from = Carbon::make($rental->from)->startOfDay();
        $to = Carbon::make($rental->to)->endOfDay();

        // Filter materials that are not rented within the specified period
        return $query->whereDoesntHave('rentals', function ($q) use ($from, $to) {
            $q->where(function ($q) use ($from, $to) {
                $q->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from, $to])
                    ->orWhere(function ($q2) use ($from, $to) {
                        $q2->where('from', '<=', $from)
                            ->where('to', '>=', $to);
                    });
            });
        });
    }

}
