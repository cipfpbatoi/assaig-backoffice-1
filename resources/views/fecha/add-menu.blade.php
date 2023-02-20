@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <section class="row single-section mx-auto mb-5 bg-dark p-5 text-light">
        <div class="offset-md-1 col-md-11 col-12 my-3">
            <h2>{{$titulo}}</h2>
        </div>
        <div class="col-12">
            <form class="mt-3" action="{{ route('fecha.add-menu') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="menu" class="form-label offset-md-2 col-md-4 col-lg-3 col-12">
                        Selecciona una imagen para el menu:
                    </label>
                    <div class="col-md-4 col-lg-5 col-12">
                        <input type="file" class="form-control" id="menu" name="menu" accept="image/*">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('menu'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('menu') }}
                        </div>
                    @endif
                </div>
                <input type="hidden" name="fecha_id" value="{{$id}}">
                <div class="offset-md-4 offset-lg-3 col-md-8 col-lg-9 col-12 px-md-1 px-0">
                    <button type="submit" class="btn btn-success btn-fijo">Subir</button>
                </div>
            </form>
        </div>
    </section>
