<?php

namespace App\Nova\Filters;

use Carbon\Carbon;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;


class MaterielDisponible extends Filter
{
    /**
     * @var string
     */
    public $component = 'date-range-filter';



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
        $from = Carbon::parse($value[0]);
        $to = Carbon::parse($value[1]);

        $query->whereDoesntHave('rentals', function ($queryTime) use ($from, $to) {
            $queryTime->where(function ($overlapQuery) use ($from, $to) {
                $overlapQuery->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from, $to])
                    ->orWhere(function ($query) use ($from, $to) {
                        $query->where('from', '<=', $from)
                            ->where('to', '>=', $to);
                    });
            });
        });

        return $query;
    }

    protected function configure(): void
    {
        if (empty($this->config)) {
            return;
        }

//    foreach ($this->config as $property => $value) {
//        if (! in_array($property, Config::getProperties(), true)) {
//            throw new InvalidArgumentException('Invalid property: ' . $property);
//        }
//
//        $this->withMeta([$property => $value]);
//    }
    }

    public function options(NovaRequest $request): array
    {
        return [];
    }

    public function key(): string
    {
        return parent::key() . '_' ;
    }

    /**
     * @return string[]
     */
//    public function default(): array
//    {
//        return array_key_exists(Config::DEFAULT_DATE, $this->config)
//            ? $this->config[Config::DEFAULT_DATE]
//            : [];
//    }
}
