<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Models\Reserva;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\HttpClient;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(HttpClient $httpClient)
    {
        $request = $httpClient->get('http://assaig.api/api/reservas', [
            'Accept' => 'application/json',
        ]);
        $reservas = json_decode($request)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($reservas, $offset, $perPage);

        $reservasPaginadas = new LengthAwarePaginator($data, count($reservas), $perPage, $page);
        return view('reserva.index', compact('reservasPaginadas'));

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
        $reserva = new Reserva();
        $reserva->nombre = $request->nombre;
        $reserva->email = $request->email;
        $reserva->telefono = $request->telefono;
        $reserva->comensales = $request->comensales;
        $reserva->observaciones = $request->observaciones;
        $reserva->localizador = $request->localizador;
        $reserva->confirmada = $request->confirmada;

        $reserva->save();
        $this->show($reserva);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(HttpClient $httpClient, $id)
    {
        $reserva = $httpClient->get('http://assaig.api/api/reservas/' . $id, [
            'Accept' => 'application/json',
        ]);
        $reserva = json_decode($reserva)->data;
        return view('reserva.show', compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HttpClient $httpClient, $id)
    {
        $reserva = $httpClient->get('http://assaig.api/api/reservas/' . $id, [
            'Accept' => 'application/json',
        ]);
        $reserva = json_decode($reserva)->data;
        $alergenos = $httpClient->get('http://assaig.api/api/alergenos', [
            'Accept' => 'application/json',
        ]);
        $alergenos = json_decode($alergenos)->data;
        return view('reserva.edit', compact($reserva, $alergenos));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HttpClient $httpClient, ReservaRequest $request, $id)
    {
        $response = $httpClient->put('http://assaig.api/api/reservas/' . $id, [
            'json' => [
                'nombre' => $request->nombre,
                'email' => $request->email,
                'telefono' =>  $request->telefono,
                'comensales' =>  $request->comensales,
                'localizador' =>  $request->localizador,
                'confirmada' =>  $request->confirmada ? 1 : 0,
            ]
        ]);

        if ($response->status() == 200) {
            return redirect()->route('reserva.index');
        } else {
            alert("Ocurrió un error al realizar la solicitud PUT.");
        }

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
