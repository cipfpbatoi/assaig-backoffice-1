<?php

namespace App\Http\Controllers;

use App\Http\HttpClient;
use App\Models\Alergeno;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AlergenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpClient $httpClient)
    {
        $datos = $httpClient->get('http://assaig.api/api/alergenos', [
            'Accept' => 'application/json',
        ]);
        $datos = json_decode($datos)->data;

        $perPage = 10;
        $page = request()->input('page', 1);
        $offset = ($page * $perPage) - $perPage;
        $data = array_slice($datos, $offset, $perPage);

        $datosPaginados = new LengthAwarePaginator($data, count($datos), $perPage, $page);

        //return view('alergeno.index', compact('datosPaginados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function show(Alergeno $alergeno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alergeno $alergeno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alergeno $alergeno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alergeno $alergeno)
    {
        //
    }
}
