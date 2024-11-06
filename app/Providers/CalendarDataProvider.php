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
    //
    // Add the Nova resources that should be displayed on the calendar to this method
    //
    // Must return an array with string keys and string or array values;
    // - each key is a Nova resource class name (eg: 'App/Nova/User::class')
    // - each value is either:
    //
    //   1. a string containing the attribute name of a DateTime casted attribute
    //      of the underlying Eloquent model that will be used as the event's
    //      starting date and time (eg.: 'created_at')
    //
    //      OR
    //
    //   2. an array containing two strings; the first is the name of the attribute
    //      that will be used as the event's starting date and time (eg.: 'starts_at'),
    //      the second will be used as the event's ending date and time (eg.: 'ends_at').
    //
    //      OR
    //
    //   3. an instance of a custom Event generator, which is generally only required
    //      if you want to create more than 1 calendar event for individual Nova resource instances
    //
    //
    // See https://github.com/wdelfuego/nova-calendar to find out
    // how to customize the way the events are displayed
    //
    public function novaResources() : array
    {
        return [

            // Events without an ending timestamp will always be shown as single-day events:
            Location::class=>['from','to']

        ];
    }

    // Use this method to show events on the calendar that don't
    // come from a Nova resource. Just return an array of dynamically
    // generated events.
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
