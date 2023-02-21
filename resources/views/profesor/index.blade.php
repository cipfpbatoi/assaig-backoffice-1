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
                    <th class="py-3">Nombre</th>
                    <th class="py-3">Tipo</th>
                    <th class="py-3">Fechas</th>
                    <th class="py-3">Aciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($profesores as $profesor)
                    <tr>
                        <td>{{$profesor->nombre}}</td>
                        <td>{{$profesor->tipo}}</td>
                        <td class="align-top">
                            <div>
                                <a class="btn btn-dark btn-fijo" href="{{ route('fechas.fechasByProfesor', $profesor->id) }}">Ver</a>
                            </div>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="align-top">
                                        <div>
                                            <a class="btn btn-success btn-fijo" href="{{ route('profesores.edit', $profesor->id) }}">Editar</a>
                                        </div>
                                    </td>
                                    <td class="align-top">
                                        <form action="{{route('profesores.destroy',  $profesor->id)}}" method="POST" class="justify-content-center mb-3" enctype="multipart/form-data">
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
                    <th class="py-3">Nombre</th>
                    <th class="py-3">Tipo</th>
                    <th class="py-3">Fechas</th>
                    <th class="py-3">Aciones</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-12">
            <a class="btn btn-lg btn-success" href="{{ route('profesores.create') }}">Añadir Profesor</a>
        </div>
    </section>
