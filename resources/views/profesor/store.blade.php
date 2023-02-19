@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <section class="row single-section mx-auto mb-5 bg-dark p-5 text-light">
        <div class="offset-md-1 col-md-11 col-12 my-3">
            <h2>{{$titulo}}</h2>
        </div>
        <div class="col-12">
            <form class="mt-3" action="{{ route('profesores.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="nombre" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Nombre</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('nombre'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="tipo" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Tipo</label>
                    <div class="col-md-2 col-12">
                        <select name="tipo" class="form-select" id="tipo">
                            <option value="sala">Sala</option>
                            <option value="cocina">Cocina</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7"></div>
                <div class="offset-md-4 offset-lg-3 col-md-8 col-lg-9 col-12 px-md-1 px-0">
                    <button type="submit" class="btn btn-success btn-fijo">Añadir</button>
                </div>
            </form>
        </div>
    </section>
