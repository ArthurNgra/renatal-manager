<?php
// Run this command to create the filter: php artisan nova:filter DateRangeFilter
// File: app/Nova/Filters/DateRangeFilter.php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\DateFilter;

class DateFiltreMaterial extends DateFilter
{
    public $name = 'Available Materials Date Range';

    public function apply(Request $request, $query, $value)
    {
        // Assuming $value will contain the date range as 'start_date to end_date'
        $dates = explode(' to ', $value);
        $from = $dates[0] ?? null;
        $to = $dates[1] ?? null;

        if ($from && $to) {
            // Apply the availableMaterials scope with the selected date range
            return $query->availableMaterials($from, $to);
        }

        return $query;
    }

    public function options(Request $request)
    {
        return [];
    }
}
