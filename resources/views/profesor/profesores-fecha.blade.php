@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <div class="row single-section mx-auto my-5 g-0">
        <h1>{{$titulo}}</h1>
    </div>
    <section class="row single-section mx-auto my-5 g-0">
        <div class="col-12">
            <table class="table table-secondary table-hover table-striped align-middle
              py-3" style="width:100%">
                <tbody>
                <tr>
                    <th class="py-3">Profesores de cocina</th>
                    @foreach($fecha->profesores_cocina ?? [] as $profesor)
                        <td>{{ $profesor->nombre }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th class="py-3">Profesores de sala</th>
                    @foreach($fecha->profesores_sala ?? [] as $profesor)
                        <td>{{ $profesor->nombre }}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </section>
