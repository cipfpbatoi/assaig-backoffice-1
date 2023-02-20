@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <div class="row single-section mx-auto my-5 g-0">
        <h1>{{$titulo}}</h1>
    </div>
    <section class="row single-section mx-auto my-5 g-0">
        <div class="col-12 py-5">
            <table class="tabla table table-secondary table-hover table-striped align-middle
             dt-responsive nowrap py-3" style="width:100%">
                <thead>
                    <tr>
                        <th class="py-3">Fecha</th>
                        <th class="py-3">Estado</th>
                        <th class="py-3">Comensales</th>
                        <th class="py-3">Nombre</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Tel&eacute;fono</th>
                        <th class="py-3">Observaciones</th>
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{$reserva->fecha->fecha}}</td>
                            @if($reserva->verify)
                                <td class="px-4">Verificada</td>
                            @else
                                <td class="px-4 text-danger">No verificada</td>
                            @endif
                            <td>{{$reserva->comensales}}</td>
                            <td>{{$reserva->nombre}}</td>
                            <td>{{$reserva->email}}</td>
                            <td>{{$reserva->telefono}}</td>
                            <td>{{$reserva->observaciones}}</td>
                            <td class="align-top">
                                <div>
                                    <a class="btn btn-dark btn-fijo" href="{{ route('reservas.show', $reserva->id) }}">Ver</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="py-2">Fecha</th>
                        <th class="py-2">Estado</th>
                        <th class="py-2">Comensales</th>
                        <th class="py-2">Nombre</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Tel&eacute;fono</th>
                        <th class="py-2">Observaciones</th>
                        <th class="py-2">Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
