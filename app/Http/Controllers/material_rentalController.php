<?php

namespace App\Http\Controllers;

use App\Models\MaterialRental;
use Illuminate\Http\Request;

class material_rentalController extends Controller
{
    public function index()
    {
        return MaterialRental::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rental_id' => ['required', 'exists:rentals'],
            'material_id' => ['required', 'exists:materials'],
        ]);

        return MaterialRental::create($data);
    }

    public function show(MaterialRental $material_rental)
    {
        return $material_rental;
    }

    public function update(Request $request, MaterialRental $material_rental)
    {
        $data = $request->validate([
            'rental_id' => ['required', 'exists:rentals'],
            'material_id' => ['required', 'exists:materials'],
        ]);

        $material_rental->update($data);

        return $material_rental;
    }

    public function destroy(MaterialRental $material_rental)
    {
        $material_rental->delete();

        return response()->json();
    }
}
