<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
use App\Models\Profesor;
use App\Models\Profesor_fecha_cocina;
use App\Models\Profesor_fecha_sala;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\HttpClient;
use Illuminate\Pagination\LengthAwarePaginator;

class FechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpClient $httpClient)
    {
        $dates = $httpClient->get('http://assaig.api/api/fechas', [
            'Accept' => 'application/json',
        ]);
        $dates = json_decode($dates)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($dates, $offset, $perPage);

        $datesPaginadas = new LengthAwarePaginator($data, count($dates), $perPage, $page);

        return view('fecha.index', compact('datesPaginadas'));
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
        return redirect()->route('fecha.show', $date);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Fecha $fecha)
    {
        return view('fecha.show', compact('fecha'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Fecha $fecha)
    {
        return view('fecha.edit', compact('fecha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Http\RedirectResponse
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

        //CAMBIAR ES PARA PRUEBAS
        $date->user_id = 1;
        //$date->user_id = $request->user_id;

        $date->save();
        return redirect()->route('fecha.show', $date);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fecha $fecha)
    {
        $fecha->delete();
        return redirect()->route('fecha');
    }
}
