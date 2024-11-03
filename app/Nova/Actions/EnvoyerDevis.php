<?php

namespace App\Nova\Actions;

use App\Mail\DevisConfirmationMail;
use App\Models\Devis;
use App\Models\DevisToken;
use App\Models\RentalModel;
use App\Services\PdfDevisService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lexicon\ActionButtonSelector\ActionAsButton;
use function asset;

class EnvoyerDevis extends Action
{
    use InteractsWithQueue, Queueable, ActionAsButton;


    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $currentUser = Auth::user();
        $company = $currentUser->company;
        foreach ($models as $devis) {
            $rentalId = $devis->rental_id;
            $client = RentalModel::find($rentalId)->client;
            $materials = array(RentalModel::find($rentalId)->materials);
            $location = RentalModel::find($rentalId);
            $token = Str::random(16);
            DevisToken::create(['devis_id' => $devis->id, 'token' => $token]);
            $fileName = 'devis_' . $location->address . '_' . Carbon::make($location->from)->format('d M Y') . '-' . Carbon::make($location->to)->format('d M Y') . '.pdf';
            $filePath = storage_path('app/private/pdf/devis/'.$client->lastname.'/'.$fileName);
            $url=  '/pdf/devis/'.$client->lastname.'/'.$fileName;
            (new PdfDevisService())->generatePDF([
                'devis' => $devis,
                'client' => $client,
                'materials' => $materials,
                'location' => $location,
                'user' => $currentUser,
                'company' => $company,
            ]);

            if (!file_exists($filePath)) {
                return response()->json(['message' => 'File not found.'], 404);
            }

            $devis->update(['downloadurl' => $url]);
            Mail::to($client->mail)->send(new DevisConfirmationMail($devis, $client, $materials, $location, $currentUser, $company, $token,$filePath));
            Devis::find($devis->id)->update(['status' => 'en cours']);

        }

    }

    /**
     * Get the fields available on the action.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }

}
