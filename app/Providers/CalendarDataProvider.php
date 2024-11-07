<?php

namespace App\Providers;

use App\Models\RentalModel;
use App\Nova\Location;
use Wdelfuego\NovaCalendar\DataProvider\AbstractCalendarDataProvider;
use Wdelfuego\NovaCalendar\Event;
use App\Nova\User;
use Wdelfuego\NovaCalendar\NovaCalendar;

class CalendarDataProvider extends AbstractCalendarDataProvider
{
    public function novaResources() : array
    {
        return [

            // Events without an ending timestamp will always be shown as single-day events:
            Location::class=>['from','to']

        ];
    }

    protected function nonNovaEvents() : array
    {
        return [
        ];
    }
    public function timezone(): string
    {
        return 'Europe/Paris';
    }
    public function initialize(): void
    {
        $this->startWeekOn(NovaCalendar::MONDAY);
    }

    public function eventStyles() : array
    {
        return [
            'default' => [
                'color' => '#fff',
                'background-color' => '#0891b2'
            ],
        ];
    }
}
