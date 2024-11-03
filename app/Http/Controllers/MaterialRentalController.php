<?php

namespace App\Http\Controllers;

use App\Models\MaterialRental;
use Illuminate\Http\Request;

class MaterialRentalController extends Controller
{
    public function index()
    {
        return MaterialRental::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return MaterialRental::create($data);
    }

    public function show(MaterialRental $materialRental)
    {
        return $materialRental;
    }

    public function update(Request $request, MaterialRental $materialRental)
    {
        $data = $request->validate([

        ]);

        $materialRental->update($data);

        return $materialRental;
    }

    public function destroy(MaterialRental $materialRental)
    {
        $materialRental->delete();

        return response()->json();
    }
}
