<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use App\Models\Equip;
use App\Models\Jugadora;
use App\Services\JugadoraService;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei)
    {
    }

    // GET /Jugadoras
    public function index() {
    $jugadoras = $this->servei->llistar();
    //dd($jugadoras->toArray()); // <-- Para depurar
    return view('jugadora.index', compact('jugadoras'));
}


    // GET /Jugadoras/create
    public function create()
    {
        $equips = Equip::all();
        return view('jugadora.create', compact('equips'));
    }

    // POST /jugadora
    public function store(StoreJugadoraRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('jugadora.index')->with('success', 'Jugadora creat correctament!');
    }

    // GET /jugadora/{Jugadora}
    public function show(Jugadora $jugadora)
    {
        return view('jugadora.show', compact('jugadora'));
    }

    // GET /jugadora/{Jugadora}/edit
    public function edit(Jugadora $jugadora)
    {
        return view('jugadora.edit', compact('jugadora'));
    }

    // PUT /jugadora/{Jugadora}
    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora)
    {
        $this->servei->actualitzar($jugadora->id, $request->validated());
        return redirect()->route('jugadora.index')->with('success', value: 'Jugadora actualitzat correctament!');
        ;
    }

    // DELETE /jugadora/{Jugadora}
    public function destroy(Jugadora $jugadora)
    {
        $this->servei->eliminar($jugadora->id);
        return redirect()->route('jugadora.index');
    }
}