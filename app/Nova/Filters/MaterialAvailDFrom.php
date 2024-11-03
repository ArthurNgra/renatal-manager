<?php

namespace App\Nova\Filters;

use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\RentalModel;
use Request;
use function dd;

class MaterialAvailDFrom extends DateFilter
{
    /**
     * The rental ID to be used for filtering.
     *
     * @var int
     */





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
        return $query->whereDoesntHave('rentals', function ($q) use ($from) {
            $q->where(function ($q) use ($from) {
                $q->where('from', '<=', $from)
                    ->where('to', '>=', $from)
                    ->orWhere('from', '>=', $from);
            });
        });
    }
}
