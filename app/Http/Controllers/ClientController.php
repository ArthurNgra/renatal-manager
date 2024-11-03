<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(ClientModel::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Society' => ['nullable'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required'],
            'mail' => ['required'],
            'address' => ['required'],
            'siret' => ['nullable'],
        ]);

        return ClientModel::create($data);
    }

    public function show(ClientModel $client)
    {
        return $client;
    }

    public function update(Request $request, ClientModel $client)
    {
        $data = $request->validate([
            'Society' => ['nullable'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required'],
            'mail' => ['required'],
            'address' => ['required'],
            'siret' => ['nullable'],
        ]);

        $client->update($data);

        return $client;
    }

    public function destroy(ClientModel $client)
    {
        $client->delete();

        return response()->json();
    }

    public function clients(){
        return response()->json(ClientModel::with('rentals')->get());
    }
}
