@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <section class="row single-section mx-auto my-5 g-0">
        <div class="row single-section mx-auto my-5 g-0">
            <h1>{{$titulo}}</h1>
        </div>
        <div class="col-12">
            <table class="table table-secondary table-hover table-striped align-middle
              py-3" style="width:100%">
                <tbody>
                    <tr>
                        <th class="py-3">Nombre</th>
                        <td>{{$reserva->nombre}}</td>
                    </tr>
                    <tr>
                        <th class="py-3">Email</th>
                        <td>{{$reserva->email}}</td>
                    </tr>
                    <tr>
                        <th class="py-3">Tel&eacute;fono</th>
                        <td>{{$reserva->telefono}}</td>
                    </tr>
                    <tr>
                        <th class="py-3">Comensales</th>
                        <td>{{$reserva->comensales}}</td>
                    </tr>
                    <tr>
                        <th class="py-3">Observaciones</th>
                        <td>{{$reserva->observaciones}}</td>
                    </tr>
                    <tr>
                        <th class="py-3">Localizador</th>
                        <td>{{$reserva->localizador}}</td>
                    </tr>
                    <tr>
                        <th class="py-3 align-top ">Al&eacute;rgenos</th>
                        <td class="text-start">
                            @if($reserva->alergenos)
                                <ul class="list-group list-group-horizontal-xl px-3">
                                    @foreach($reserva->alergenos ?? [] as $alergeno)
                                        <li class="list-group-item flex-fill">
                                            <p>{{ $alergeno->nombre }}</p>
                                            <img class="alergeno-img" src="/img/alergenos/{{$alergeno->icono}}.png" alt="{{ $alergeno->nombre }}">
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                            Ninguno
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="py-3">Confirmada</th>
                        <td>
                            @if($reserva->confirmada)
                                S&iacute;
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 pb-5">

        </div>
    </section>
