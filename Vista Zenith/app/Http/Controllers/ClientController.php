<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Vente;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->withCount('ventes')->get();
        return view('clients', compact('clients'));
    }

    public function achats(int $id)
    {
        $client = Client::findOrFail($id);
        $ventes = Vente::with(['personnel', 'ligneVente.article'])
            ->where('client_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('achats', compact('ventes', 'client'));
    }

    public function store(ClientRequest $request)
    {
        $request->validated();
        Client::create([
            'prenoms' => $request->input('firstname'),
            'nom' => $request->input('lastname'),
            'telephone' => $request->input('phone'),
            'adresse' => $request->input('address'),
        ]);

        return redirect()->route('clients.index')->with('success', 'Client added successfully');
    }
}
