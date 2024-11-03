<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Company::class);

        return Company::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

        $data = $request->validate([
            'adresse' => ['required'],
            'town' => ['required'],
            'country' => ['required'],
            'phone' => ['required'],
            'mail' => ['required'],
            'siret' => ['required'],
        ]);

        return Company::create($data);
    }

    public function show(Company $company)
    {
        $this->authorize('view', $company);

        return $company;
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $data = $request->validate([
            'adresse' => ['required'],
            'town' => ['required'],
            'country' => ['required'],
            'phone' => ['required'],
            'mail' => ['required'],
            'siret' => ['required'],
        ]);

        $company->update($data);

        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return response()->json();
    }
}
