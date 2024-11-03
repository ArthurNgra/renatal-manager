<?php

namespace App\Nova\Actions;

use App\Models\Package;
use App\Services\PackageService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
//use Lexicon\ActionButtonSelector\ActionAsButton;

class Pack extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $from = null;
        $to = null;
        $rentalId = null;
        foreach ($models as $model) {
            $from = $model->from;
            $to = $model->to;
            $rentalId = $model->id;
        }

        PackageService::attachMaterialsToRentalDependingOnPackage(
            $rentalId,
            $fields->pack,  // This is now the package name
            Carbon::make($from)->startOfDay(),
            Carbon::make($to)->endOfDay()
        );
    }

    /**
     * Get the fields available on the action.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $packNames = Package::pluck('name', 'name'); // key-value pairs of package names
        return [
            Select::make('Pack', 'pack')
                ->options($packNames)
                ->displayUsingLabels()
                ->required(),
        ];
    }
}
