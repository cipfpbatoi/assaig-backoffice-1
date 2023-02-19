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
        $profesores = json_decode($datos)->data;

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['name' => 'Profesores']
        ];

        $titulo = 'Lista de profesores';
        return view('profesor.index', compact('profesores','titulo', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $breadcrumbs = [
        ['link' => '/', 'name' => 'Home'],
        ['link' => '/profesores', 'name' => 'Profesores'],
        ['name' => 'Añadir profesor']
    ];

        $titulo = 'Nuevo profesor';
        return view('profesor.store', compact('breadcrumbs', 'titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProfesorRequest $request)
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
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/profesores', 'name' => 'Profesores'],
            ['name' => 'Editar']
        ];

        $titulo = 'Editar Profesor';
        return view('profesor.edit', compact('profesor', 'id', 'breadcrumbs', 'titulo'));
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

    public function profesoresByFecha(HttpClient $httpClient, $fechaId)
    {
        $request = $httpClient->get('http://assaig.api/api/fechas/' . $fechaId, [
            'Accept' => 'application/json',
        ]);
        $fecha = json_decode($request)->data;
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/profesores', 'name' => 'Profesores'],
            ['name' => $fecha->fecha]
        ];

        $titulo = 'Profesores para el día ' . $fecha->fecha;
        return view('profesor.profesores-fecha', compact('fecha', 'breadcrumbs', 'titulo'));
    }
}
