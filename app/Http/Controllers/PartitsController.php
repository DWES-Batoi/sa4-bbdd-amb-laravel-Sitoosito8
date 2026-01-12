<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Partit;
use App\Services\PartitService;

class PartitsController extends Controller
{
    public function __construct(private PartitService $servei)
    {
    }

    // GET /Partitss
    public function index() {
    $partits = $this->servei->llistar();
    //dd($partits->toArray()); // <-- Para depurar
    return view('partit.index', compact('partits'));
}


    // GET /Partitss/create
    public function create()
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partit.create', compact('equips','estadis'));
    }

    // POST /partit
    public function store(StorePartitRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('partit.index')->with('success', 'Partits creat correctament!');
    }

    // GET /partit/{Partits}
    public function show(Partit $partit)
    {
        return view('partit.show', compact('partit'));
    }

    // GET /partit/{Partits}/edit
    public function edit(Partit $partit)
    {
        return view('partit.edit', compact('partit'));
    }

    // PUT /partit/{Partits}
    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $this->servei->actualitzar($partit->id, $request->validated());
        return redirect()->route('partit.index')->with('success', value: 'Partits actualitzat correctament!');
        ;
    }

    // DELETE /partit/{Partits}
    public function destroy(Partit $partit)
    {
        $this->servei->eliminar($partit->id);
        return redirect()->route('partit.index');
    }
}