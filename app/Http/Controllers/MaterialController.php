<?php

namespace App\Http\Controllers;

use App\Models\MaterialModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        return MaterialModel::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => ['required'],
            'model' => ['required'],
            'serial' => ['required'],
            'spec' => ['nullable'],
            'issues' => ['nullable', 'boolean'],
        ]);

        return MaterialModel::create($data);
    }

    public function show(MaterialModel $material)
    {
        return $material;
    }

    public function update(Request $request, MaterialModel $material)
    {
        $data = $request->validate([
            'brand' => ['required'],
            'model' => ['required'],
            'serial' => ['required'],
            'spec' => ['nullable'],
            'issues' => ['nullable', 'boolean'],
        ]);

        $material->update($data);

        return $material;
    }

    public function destroy(MaterialModel $material)
    {
        $material->delete();

        return response()->json();
    }

    public function getAvailableMaterials(Request $request)
    {
        $from=$request->query('from');
        $to=$request->query('to');
        return MaterialModel::whereDoesntHave('rentals', function($query) use ($to, $from) {
            $query->where(function($query) use ($from, $to) {
                $query->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from,$to])
                    ->orWhere(function($query) use ($to, $from) {
                        $query->where('from', '<=', $from)
                            ->where('to', '>=', $to);
                    });
            });
        })->get();

    }
}
