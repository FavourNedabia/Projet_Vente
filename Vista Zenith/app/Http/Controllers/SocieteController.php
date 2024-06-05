<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocieteRequest;
use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{

    public function index()
    {
        $societes = Societe::orderBy('id', 'desc')->get();
        return view('societes', compact('societes'));
    }


    public function store(SocieteRequest $request)
    {
        Societe::create($request->validated());

        return redirect()->route('societes.index')->with('success', 'Société ajoutée avec succès.');
    }
}
