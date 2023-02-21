<?php

namespace App\Http\Controllers;

use App\Http\Requests\FechaUpdateRequest;
use App\Models\Fecha;
use App\Models\Profesor;
use App\Models\Profesor_fecha_cocina;
use App\Models\Profesor_fecha_sala;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\HttpClient;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

const SERVER = 'http://api.saar.alcoitec.es/';
class FechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(HttpClient $httpClient)
    {
        $datos = $httpClient->get(SERVER . 'api/fechas', [
            'Accept' => 'application/json',
        ]);
        $dates = json_decode($datos)->data;

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['name' => 'Fechas']
        ];

        $titulo = 'Lista de fechas';

        return view('fecha.index', compact('dates', 'breadcrumbs', 'titulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(HttpClient $httpClient)
    {
        $profesores = $httpClient->get(SERVER . 'api/profesores', [
            'Accept' => 'application/json',
        ]);
        $profesores = json_decode($profesores)->data;
        $profesoresSala = [];
        $profesoresCocina = [];
        foreach ($profesores as $profesor){
            if($profesor->tipo === 'sala'){
                array_push($profesoresSala, $profesor);
            }else{
                array_push($profesoresCocina, $profesor);
            }
        }

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/fechas', 'name' => 'Fechas'],
            ['name' => 'Añadir fecha']
        ];

        $titulo = 'Nueva fecha';

        return view('fecha.store', compact('profesoresSala', 'profesoresCocina', 'breadcrumbs', 'titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FechaUpdateRequest $request)
    {
        $response = Http::asForm()->post(SERVER . 'api/fechas', [
            'fecha'=>$request->fecha,
            'pax'=>$request->pax,
            'overbooking'=>$request->overbooking,
            'pax_espera'=>$request->pax_espera,
            'horario_apertura'=>$request->horario_apertura,
            'horario_cierre'=>$request->horario_cierre,
            'profesores_sala'=>$request->profesores_sala,
            'profesores_cocina'=>$request->profesores_cocina,
        ]);

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
        $fecha = $httpClient->get(SERVER . 'api/fechas/' . $fecha->id, [
            'Accept' => 'application/json',
        ]);
        $fecha = json_decode($fecha)->data;

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/fechas', 'name' => 'Home'],
            ['name' => $fecha->fecha]
        ];

        $titulo = 'Detalles del día ' . $fecha->fecha;
        return view('fecha.show', compact('fecha', 'breadcrumbs', 'titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fecha  $fecha
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(HttpClient $httpClient, Fecha $fecha)
    {
        $fecha = $httpClient->get(SERVER . 'api/fechas/' . $fecha->id, [
            'Accept' => 'application/json',
        ]);
        $fecha = json_decode($fecha)->data;
        $horarioApertura = $fecha->horario_apertura;
        $horarioApertura = Carbon::parse($horarioApertura);
        $horarioApertura = $horarioApertura->format('H:i');

        $horarioCierre = $fecha->horario_cierre;
        $horarioCierre = Carbon::parse($horarioCierre);
        $horarioCierre = $horarioCierre->format('H:i');

        $profesores = $httpClient->get(SERVER . 'api/profesores', [
            'Accept' => 'application/json',
        ]);
        $profesores = json_decode($profesores)->data;
        $profesores_sala_fecha = $fecha->profesores_sala;
        $profesores_cocina_fecha = $fecha->profesores_cocina;

        $profesoresSalaNombres = array_column($profesores_sala_fecha, 'nombre');
        $profesoresCocinaNombres = array_column($profesores_cocina_fecha, 'nombre');

        $profesoresSala = [];
        $profesoresCocina = [];
        foreach ($profesores as $profesor){
           if($profesor->tipo === 'sala')
           {
               array_push($profesoresSala, $profesor);
           }else{
               array_push($profesoresCocina, $profesor);
           }
        }
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/fechas', 'name' => 'Fechas'],
            ['name' => 'Crear fecha']
        ];

        $titulo = 'Editar fecha';
        return view('fecha.edit', compact('fecha', 'profesoresSalaNombres',
            'profesoresCocinaNombres','profesoresSala', 'profesoresCocina', 'horarioApertura', 'horarioCierre',
        'titulo', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fecha  $fecha
     * @return int
     */
    public function update(FechaUpdateRequest $request, $fechaId)
    {
        $response = Http::asForm()->put(SERVER . 'api/fechas/' . $fechaId, [
            'fecha'=>$request->fecha,
            'pax'=>$request->pax,
            'overbooking'=>$request->overbooking,
            'pax_espera'=>$request->pax_espera,
            'horario_apertura'=>$request->horario_apertura,
            'horario_cierre'=>$request->horario_cierre,
            'profesores_sala'=>$request->profesores_sala,
            'profesores_cocina'=>$request->profesores_cocina,
        ]);
        if ($response->status()=== 201) {
            return redirect()->route('fechas.index');
        }else{
            return $response->status();
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
        $response = Http::delete(SERVER . 'api/fechas/' . $fecha->id, (array)$fecha);
        if ($response->status()=== 204) {
            return redirect()->route('fechas.index');
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
    public function fechasByProfesor(HttpClient $httpClient, $profesorId)
    {
        $request = $httpClient->get(SERVER . 'api/profesores/' . $profesorId, [
            'Accept' => 'application/json',
        ]);
        $profesor = json_decode($request)->data;
        $profesor = $profesor->nombre;
        $request = $httpClient->get('http://assaig.api/api/fechas-profesor/' . $profesorId, [
            'Accept' => 'application/json',
        ]);
        $fechas = json_decode($request)->data;

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/fechas', 'name' => 'Fechas'],
            ['name' => $profesor]
        ];

        $titulo = 'Fechas de ' . $profesor;

        return view('fecha.fechas-profesor', compact('fechas', 'profesor', 'titulo', 'breadcrumbs'));
    }

    public function create_menu($id)
    {
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => '/fechas', 'name' => 'Fechas'],
            ['name' => 'Crear menú']
        ];

        $titulo = 'Añadir menú';
        return view('fecha.add-menu', compact('breadcrumbs', 'titulo', 'id'));
    }

    public function add_menu(Request $request)
    {
        $file = $request->file('menu');
        $fileName = $file->getClientOriginalName();

        $file->storeAs('/img/menus/', $fileName);

        $client = new Client();
        $response = $client->request('POST', SERVER . 'api/fecha/add-menu', [
            'multipart' => [
                [
                    'name'     => 'menu',
                    'contents' => fopen(storage_path('app/img/menus/' . $fileName), 'r'),
                    'filename' => $fileName,
                ],
                [
                    'name' => 'id',
                    'contents' => $request->fecha_id,
                ]
            ],
        ]);

        if ($response->getStatusCode()=== 201) {
            return redirect()->route('fechas.index');
        }else{
            return redirect()->route('home');
        }
    }
}
