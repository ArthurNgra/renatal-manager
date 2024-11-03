<?php

namespace App\Http\Controllers;

use App\Models\RentalModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function to_route;

class RentalController extends Controller
{
    public function index()
    {
        return RentalModel::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'referal_phone' => ['nullable'],
            'address' => ['required'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
            'special_demands' => ['nullable'],
            'materials.*.id' => ['nullable', 'exists:materials,id'],
        ]);
        $rental = RentalModel::create($data);
        if (isset($data['materials'])) {
            $rental->materials()->attach(array_column($data['materials'], 'id'));
        }


        return $rental;
    }

    public function show(RentalModel $rental)
    {
        return $rental;
    }

    public function update(Request $request, RentalModel $rental)
    {
        $data = $request->validate([
            'client_id' => ['required', 'exists:clients'],
            'referal_phone' => ['nullable'],
            'address' => ['required'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
            'special_demands' => ['nullable'],
        ]);

        $rental->update($data);

        return $rental;
    }

    public function destroy(RentalModel $rental)
    {
        $rental->delete();

        return response()->json();
    }
}
