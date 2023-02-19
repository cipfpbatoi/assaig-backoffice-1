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
                    <th class="py-3">Pax</th>
                    <th class="py-3">Overbooking</th>
                    <th class="py-3">Pax espera</th>
                    <th class="py-3">Horario de apertura</th>
                    <th class="py-3">Horario de cierre	</th>
                    <th class="py-3">Informaci&oacute;n</th>
                    <th class="py-3">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fechas as $date)
                    <tr>
                        <td>{{$date->fecha}}</td>
                        <td>{{$date->pax}}</td>
                        <td>{{$date->overbooking}}</td>
                        <td>{{$date->pax_espera}}</td>
                        <td>{{$date->horario_apertura}}</td>
                        <td>{{$date->horario_cierre}}</td>
                        <td class="align-top">
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <a class="btn btn-dark btn-fijo" href="{{ route('reservas.reservasFecha', $date->id) }}">Reservas</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a class="btn btn-dark btn-fijo" href="{{ route('profesores.profesoresByFecha', $date->id) }}">Profesores</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="align-top">
                                        <div>
                                            <a class="btn btn-success btn-fijo" href="{{ route('fechas.edit', $date->id) }}">Editar</a>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{route('fechas.destroy',  $date->id)}}" method="POST" class="justify-content-center mb-3" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-fijo">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="py-3">Fecha</th>
                    <th class="py-3">Pax</th>
                    <th class="py-3">Overbooking</th>
                    <th class="py-3">Pax espera</th>
                    <th class="py-3">Horario de apertura</th>
                    <th class="py-3">Horario de cierre	</th>
                    <th class="py-3">Informaci&oacute;n</th>
                    <th class="py-3">Acciones</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </section>
