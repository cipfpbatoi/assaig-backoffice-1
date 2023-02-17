<?php

namespace App\Http\Controllers;

use App\Http\HttpClient;
use App\Http\Requests\ProfesorRequest;
use App\Models\Fecha;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(HttpClient $httpClient)
    {
        $datos = $httpClient->get('http://assaig.api/api/profesores', [
            'Accept' => 'application/json',
        ]);
        $datos = json_decode($datos)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($datos, $offset, $perPage);

        $datosPaginados = new LengthAwarePaginator($data, count($datos), $perPage, $page);

        return view('profesor.index', compact('datosPaginados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('profesor.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $response = Http::asForm()->post('http://assaig.api/api/profesores', $request);
        if ($response->status()=== 201) {
            return redirect()->route('profesores.index');
        }else{
            return redirect()->route('profesores.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(HttpClient $httpClient, Profesor $profesor)
    {
        $profesor = $httpClient->get('http://assaig.api/api/profesores/' . $profesor->id, [
            'Accept' => 'application/json',
        ]);
        $profesor = json_decode($profesor)->data;
        return view('profesor.show', compact('profesor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HttpClient $httpClient, $id)
    {
        $profesor = $httpClient->get('http://assaig.api/api/profesores/' . $id, [
            'Accept' => 'application/json',
        ]);
        $profesor = json_decode($profesor)->data;
        return view('profesor.edit', compact('profesor', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfesorRequest $request, $profesor)
    {
        $response = Http::put('http://assaig.api/api/profesores/'.$profesor, [
            'nombre'=>$request->nombre,
            'tipo'=>$request->tipo
        ]);

        if ($response->status()=== 200) {
            return redirect()->route('profesores.index');
        } else {
            return response()->json(['error' => $response->status()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($profesorId)
    {
        $response = Http::delete('http://assaig.api/api/profesores/' . $profesorId, $profesorId);
        if ($response->status()=== 204) {
            return redirect()->route('profesores.index');
        }else{
            return redirect()->route('fechas.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profesoresByFechas(HttpClient $httpClient, $profesorId)
    {
        $request = $httpClient->get('http://assaig.api/api/profesores/' . $profesorId, [
            'Accept' => 'application/json',
        ]);
        $profesor = json_decode($request)->data;
        $profesor = $profesor->nombre;
        $request = $httpClient->get('http://assaig.api/api/fechas-profesor/' . $profesorId, [
            'Accept' => 'application/json',
        ]);
        $fechas = json_decode($request)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($fechas, $offset, $perPage);

        $fechasPaginados = new LengthAwarePaginator($data, count($fechas),$perPage, $page);

        return view('profesor.list', compact('fechasPaginados', 'profesor'));
    }
}
