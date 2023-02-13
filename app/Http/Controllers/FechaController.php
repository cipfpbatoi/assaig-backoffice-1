<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
use App\Models\Profesor;
use App\Models\Profesor_fecha_cocina;
use App\Models\Profesor_fecha_sala;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class FechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates = Fecha::paginate(10);
        return view('fecha.index', compact('dates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('fecha.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $date = new Fecha();
        $date->fecha = $request->fecha;
        $date->pax = $request->pax;
        $date->overbooking = $request->overbooking;
        $date->pax_espera = $request->pax_espera;
        $date->horario_apertura = $request->horario_apertura;
        $date->horario_cierre = $request->horario_cierre;

        //CAMBIAR ES PARA PRUEBAS
        $date->user_id = 1;
        //$date->user_id = $request->user_id;

        $date->save();
        return redirect()->route('fecha.show', $date->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $date = Fecha::findOrFail($id);

        return view('fecha.show', compact('date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $date = Fecha::findOrFail($id);
        return view('fecha.edit', compact('date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fecha $fecha)
    {
        $date = Fecha::find($fecha->id);
        $date->fecha = $request->fecha;
        $date->pax = $request->pax;
        $date->overbooking = $request->overbooking;
        $date->pax_espera = $request->pax_espera;
        $date->horario_apertura = $request->horario_apertura;
        $date->horario_cierre = $request->horario_cierre;
        $date->user_id = $request->user_id;

        $date->save();
        $this->show($date);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fecha $fecha)
    {
        $date = Fecha::find($fecha->id);
        $date->delete();
        $this->index();
    }
}
