<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\HttpClient;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

const SERVER = 'http://api.saar.alcoitec.es/';
class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(HttpClient $httpClient)
    {
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['name' => 'Reservas']
        ];

        $request = $httpClient->get(SERVER . 'api/reservas', [
            'Accept' => 'application/json',
        ]);
        $reservas = json_decode($request)->data;

        $titulo = 'Lista de Reservas';
        return view('reserva.index', compact('reservas', 'titulo', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('reserva.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(HttpClient $httpClient, $id)
    {
        $reserva = $httpClient->get(SERVER . 'api/reservas/' . $id, [
            'Accept' => 'application/json',
        ]);
        $reserva = json_decode($reserva)->data;

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/reservas', 'name' => 'Reservas'],
            ['name' => 'Reserva ' . $reserva->localizador]
        ];
        $titulo = 'Reserva ' . $reserva->localizador;
        return view('reserva.show', compact('reserva', 'titulo', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HttpClient $httpClient, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HttpClient $httpClient, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    public function confirmar(HttpClient $httpClient, $id)
    {
        if ($httpClient->get(SERVER . 'api/confirmar-reserva/' . $id)) {
            return redirect()->route('reservas.index');
        } else {
            echo "Error al realizar la solicitud PUT";
        }
    }

    public function pendientes(HttpClient $httpClient)
    {
        $request = $httpClient->get(SERVER . 'api/reservas-pendientes', [
            'Accept' => 'application/json',
        ]);
        $reservas = json_decode($request)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($reservas, $offset, $perPage);

        $reservasPaginadas = new LengthAwarePaginator($data, count($reservas), $perPage, $page);

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/reservas', 'name' => 'Reservas'],
            ['name' => 'Reservas pendientes']
        ];
        $titulo = 'Reservas Pendientes';
        return view('reserva.index', compact('reservasPaginadas', 'titulo', 'breadcrumbs'));

    }

    public function reservasFecha(HttpClient $httpClient, $fechaId)
    {
        $request = $httpClient->get(SERVER . 'api/reservas-fecha/' . $fechaId, [
            'Accept' => 'application/json',
        ]);
        $reservas = json_decode($request)->data;
        $fecha = $httpClient->get(SERVER . 'api/fechas/' . $fechaId);
        //$fecha = $reservas[0]->fecha;
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/reservas', 'name' => 'Reservas'],
            ['name' => 'Reservas de ' . $fecha->fecha]
        ];
        $titulo = 'Reservas para el día ' . $fecha->fecha;
        return view('reserva.index', compact('reservas', 'titulo', 'breadcrumbs'));
    }
}
