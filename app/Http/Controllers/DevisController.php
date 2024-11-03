<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Devis;
use App\Models\DevisToken;
use App\Models\RentalModel;
use App\Services\PdfDevisService;
use App\Services\PdfInvoiceService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\URL;
use function compact;
use function view;

class DevisController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Devis::class);

        return Devis::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Devis::class);

        $data = $request->validate([
            'status' => ['boolean'],
            'rental_id' => ['required', 'exists:rentals'],
        ]);

        return Devis::create($data);
    }

    public function show(Devis $devis)
    {
        $this->authorize('view', $devis);

        return $devis;
    }

    public function update(Request $request, Devis $devis)
    {
        $this->authorize('update', $devis);

        $data = $request->validate([
            'status' => ['string'],
            'rental_id' => ['required', 'exists:rentals'],
        ]);

        $devis->update($data);

        return $devis;
    }

    public function destroy(Devis $devis)
    {
        $this->authorize('delete', $devis);

        $devis->delete();

        return response()->json();
    }

    public function changeStatus(Request $request, int $devisId)
    {

        $status = request()->query('status');
        $token = request()->query('token');

        $model = Devis::find($devisId)->getClient();
        $devisToken = DevisToken::where('devis_id', $devisId)
            ->where('token','LIKE', $token)->firstOrFail();;
        $devis=Devis::find($devisId);
        if ($devisToken->exists() && !$devisToken->used) {
            $devis_status = Devis::find($devisId)->update(['status' => $status]);
            $users = Company::find(1)->users;
            $company = Company::find(1)->mail;


            foreach ($users as $user) {
                $user->notify(
                    NovaNotification::make()
                        ->message('devis' . ' ' . $model->Society . ' ' . $model->firstname . ' ' . $model->lastname . ' ' . $status)
                        ->action('Facture', URL::remote('/resources/factures/new?relationshipType=hasMany&viaRelationship=factures&viaResource=devis&viaResourceId=' . $devisId))
                        ->type($status == 'valider' ? 'success' : 'error')
                );
            }
            $devisToken->update(['used' => true]);

            return view('devis.confirmation-acceptation', compact('status', 'devis_status', 'company'));
        } else {
            return view('devis.alreadyAccepted');
        }

    }
}
