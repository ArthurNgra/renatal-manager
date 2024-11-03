<?php

namespace App\Nova\Filters;

use Illuminate\Support\Carbon;
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
        $from = \Carbon\Carbon::parse($value)->startOfDay();

        // Apply the overlap logic, only considering rentals that interfere with the `from` date onwards
        return $query->whereDoesntHave('rentals', function ($q) use ($value) {
            $q->where(function ($q) use ($value) {
                $q->where('from', '<=', $value)
                    ->where('to', '>=', $value)
                    ->orWhere('to', '<=', $value);
            });
        });

    }
}
