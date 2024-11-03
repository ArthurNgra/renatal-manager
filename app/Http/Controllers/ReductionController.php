<?php

namespace App\Http\Controllers;

use App\Models\Reduction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReductionController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Reduction::class);

        return Reduction::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Reduction::class);

        $data = $request->validate([
            'type' => ['required'],
            'valeur' => ['required', 'integer'],
        ]);

        return Reduction::create($data);
    }

    public function show(Reduction $reduction)
    {
        $this->authorize('view', $reduction);

        return $reduction;
    }

    public function update(Request $request, Reduction $reduction)
    {
        $this->authorize('update', $reduction);

        $data = $request->validate([
            'type' => ['required'],
            'valeur' => ['required', 'integer'],
        ]);

        $reduction->update($data);

        return $reduction;
    }

    public function destroy(Reduction $reduction)
    {
        $this->authorize('delete', $reduction);

        $reduction->delete();

        return response()->json();
    }
}
