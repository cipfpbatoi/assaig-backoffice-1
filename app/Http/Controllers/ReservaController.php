<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reservas = Reserva::paginate(10);
        return view('reserva.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('reservas.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->nombre = $request->nombre;
        $reserva->email = $request->email;
        $reserva->telefono = $request->telefono;
        $reserva->comensales = $request->comensales;
        $reserva->observaciones = $request->observaciones;
        $reserva->localizador = $request->localizador;
        $reserva->confirmada = $request->confirmada;

        try {
            $reserva->save();
            return response()->json($reserva, 201);
        }catch (QueryException $e){
            return response()->json([$e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        $reservaToFind = Reserva::findOrFail($reserva->id);
        return view('reserva.show', compact('reservaToFind'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        $reservaToFind = Reserva::findOrFail($reserva->id);
        return view('reserva.edit', compact($reservaToFind));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        $reservaToEdit = Reserva::find($reserva->id);
        $reservaToEdit->nombre = $request->nombre;
        $reservaToEdit->email = $request->email;
        $reservaToEdit->telefono = $request->telefono;
        $reservaToEdit->comensales = $request->comensales;
        $reservaToEdit->observaciones = $request->observaciones;
        $reservaToEdit->localizador = $request->localizador;
        $reservaToEdit->confirmada = $request->confirmada;
        $reservaToEdit->save();

        return view('reserva.show', compact('reservaToEdit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        $reservaToDelete = Reserva::find($reserva->id);
        $reservaToDelete->delete();
        $this->index();
    }
}
