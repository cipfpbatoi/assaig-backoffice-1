<?php

namespace App\Http\Controllers;

use App\Http\Requests\FechaUpdateRequest;
use App\Models\Fecha;
use App\Models\Profesor;
use App\Models\Profesor_fecha_cocina;
use App\Models\Profesor_fecha_sala;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\HttpClient;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class FechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(HttpClient $httpClient)
    {
        $datos = $httpClient->get('http://assaig.api/api/fechas', [
            'Accept' => 'application/json',
        ]);
        $datos = json_decode($datos)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($datos, $offset, $perPage);

        $datesPaginadas = new LengthAwarePaginator($data, count($datos), $perPage, $page);

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
        /*$date = new Fecha();
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
        return redirect()->route('fecha.show', $date);*/

        $response = Http::asForm()->post('http://assaig.api/api/fechas', $request);
        if ($response->status()=== 201) {
            return redirect()->route('fechas.index');
        }else{
            return redirect()->route('fechas.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(HttpClient $httpClient, Fecha $fecha)
    {
        $fecha = $httpClient->get('http://assaig.api/api/fechas/' . $fecha->id, [
            'Accept' => 'application/json',
        ]);
        $fecha = json_decode($fecha)->data;
        return view('fecha.show', compact('fecha'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HttpClient $httpClient, Fecha $fecha)
    {
        $fecha = $httpClient->get('http://assaig.api/api/fechas/' . $fecha->id, [
            'Accept' => 'application/json',
        ]);
        $fecha = json_decode($fecha)->data;

        $profesores = $httpClient->get('http://assaig.api/api/profesores', [
            'Accept' => 'application/json',
        ]);
        $profesores = json_decode($profesores)->data;
        $profesores_sala_fecha = $fecha->profesores_sala;
        $profesores_cocina_fecha = $fecha->profesores_cocina;

        $profesorSala = [];
        $profesorCocina = [];
        foreach ($profesores as $profesor){
           if($profesor->tipo === 'sala')
           {
               array_push($profesorSala, $profesor);
           }else{
               array_push($profesorCocina, $profesor);
           }
        }

        return view('fecha.edit', compact('fecha', 'profesorCocina', 'profesores_cocina_fecha', 'profesores_sala_fecha', 'profesorSala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FechaUpdateRequest $request, $fechaId)
    {
        /*$date = Fecha::find($fecha->id);
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
        return redirect()->route('fecha.show', $date);*/

        $response = Http::asForm()->put('http://assaig.api/api/fechas/' . $fechaId, [
            'fecha'=>$request->fecha,
            'pax'=>$request->pax,
            'overbooking'=>$request->overbooking,
            'pax_espera'=>$request->pax_espera,
            'horario_apertura'=>$request->horario_apertura,
            'horario_cierre'=>$request->horario_cierre,
        ]);
        if ($response->status()=== 200) {
            return redirect()->route('fechas.index');
        }else{
            return redirect()->route('fechas.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fecha $fecha)
    {
        /*$fecha->delete();
        return redirect()->route('fecha');*/
        $response = Http::delete('http://assaig.api/api/fechas/' . $fecha->id, (array)$fecha);
        if ($response->status()=== 204) {
            return redirect()->route('fechas.index');
        }else{
            return redirect()->route('fechas.index');
        }
    }
}
