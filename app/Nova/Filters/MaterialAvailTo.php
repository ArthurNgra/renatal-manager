<?php

namespace App\Nova\Filters;

use Ampeco\Filters\DateRangeFilter;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class MaterialAvailTo extends DateFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(\Illuminate\Http\Request $request, $query, $value)
    {
        // Parse the 'from' date from the filter input and set it to the start of the day
        $from = Carbon::parse($value)->startOfDay();

        // Get the IDs of materials that are already reserved
        $reservedMaterialIds = DB::table('Materials')
            ->join('material_rental', 'Materials.id', '=', 'material_rental.material_id')
            ->join('rentals', 'material_rental.rental_id', '=', 'rentals.id')
            ->where('rentals.to', '>=', $from->startOfDay())
            ->pluck('Materials.id');

        // Apply the filter to exclude reserved materials
        return $query->whereNotIn('id', $reservedMaterialIds);
    }
}
