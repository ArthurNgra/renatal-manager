<?php

namespace App\Nova\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Fields\Filters\DateFilter;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class MaterialDateRangeFilter extends \Laravel\Nova\Filters\DateFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {


        // Exclude materials that are rented during the date range
        return $query->whereDoesntHave('rentals', function (Builder $rentalQuery)  {
            $rentalQuery->where(function ($query)  {
                // Ensure there's no overlap with the given date range
                $query->where('from', '<=', Carbon::now()->subDays(30))
                    ->where('to', '>=', Carbon::now());
            });
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return [];
    }
}
