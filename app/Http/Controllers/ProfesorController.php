<?php

namespace App\Http\Controllers;

use App\Http\HttpClient;
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

        /*$profesor = new Profesor();
        $profesor->nombre = $request->nombre;
        $profesor->tipo = $request->tipo;
        $profesor->save();*/

        /*$response = Http::asForm()->post('http://assaig.api/api/profesores', [
            'nombre' => $request->nombre,
            'tipo' => $request->tipo
        ]);*/
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
        //$profesorToFind = Profesor::findOrFail($profesor->id);
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
    public function update(Request $request, Profesor $profesor)
    {
        /*$profesor->nombre = $request->nombre;
        $profesor->tipo = $request->tipo;
        $profesor->save();*/

        $response = Http::asForm()->put('http://assaig.api/api/profesores/' . $profesor->id, $request);
        if ($response->status()=== 200) {
            return redirect()->route('profesores.index');
        }else{
            return redirect()->route('profesores.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Profesor $profesor)
    {
        /*$profesorToDelete = Profesor::find($profesor->id);
        $profesorToDelete->delete();
        $this->index();*/
        $response = Http::delete('http://assaig.api/api/profesores', $profesor);

        if ($response->status()=== 204) {
            return redirect()->route('profesores.index');
        }else{
            return redirect()->route('profesores.edit', compact('profesor'));
        }
    }
}
