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
                        <th class="py-3">Comensales</th>
                        <th class="py-3">Nombre</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Tel&eacute;fono</th>
                        <th class="py-3">Observaciones</th>
                        <th class="py-3">Confirmaci&oacute;n</th>
                        <th class="py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{$reserva->fecha->fecha}}</td>
                            <td>{{$reserva->comensales}}</td>
                            <td>{{$reserva->nombre}}</td>
                            <td>{{$reserva->email}}</td>
                            <td>{{$reserva->telefono}}</td>
                            <td>{{$reserva->observaciones}}</td>
                            @if($reserva->confirmada === 1)
                                <td class="px-4">Confirmada</td>
                            @else
                                <td>
                                    <form action="{{route('reservas.confirmar',  $reserva->id)}}" method="POST" class="justify-content-center" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-fijo">Confirmar</button>
                                    </form>
                                </td>
                            @endif
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
                        <th class="py-2">Comensales</th>
                        <th class="py-2">Nombre</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Tel&eacute;fono</th>
                        <th class="py-2">Observaciones</th>
                        <th class="py-2">Confirmaci&oacute;n</th>
                        <th class="py-2">Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
