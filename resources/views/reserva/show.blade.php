@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <section class="row single-section mx-auto my-5 bg-light g-0">
        <div class="">
            <h4 class="text-uppercase font-weight-bold">Detalle de las Reservas </h4>
            <div class="border border-primary rounded shadow-lg p-3 w-50">
                <p>Nombre: {{$reserva->nombre}}</p>
                <p>Email: {{$reserva->email}}</p>
                <p>Telefono: {{$reserva->telefono}}</p>
                <p>Comensales: {{$reserva->comensales}}</p>
                <p>Observaciones: {{$reserva->observaciones}}</p>
                <p>Localizador: {{$reserva->localizador}}</p>

                <p>Listado Alergenos</p>
                <ul>
                    @foreach($reserva->alergeno_reservas ?? [] as $alergeno)
                        <li>{{ $alergeno->alergeno->nombre }}</li>
                    @endforeach
                </ul>


                @if($reserva->confirmada)
                    <p>La reserva esta confirmada</p>
                @else
                    <p>No esta conformada aun la reserva</p>
                @endif
            </div>
        </div>
    </section>

