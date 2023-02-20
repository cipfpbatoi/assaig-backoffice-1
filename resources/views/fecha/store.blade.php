@extends('layout.layout')
@section('title', "L'assaig - " . $titulo)
@section('content')
    @include('partials.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    <section class="row single-section mx-auto mb-5 bg-dark p-5 text-light">
        <div class="offset-md-1 col-md-11 col-12 my-3">
            <h2>{{$titulo}}</h2>
        </div>
        <div class="col-12">
            <form class="mt-3" action="{{ route('fechas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="fecha" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Fecha</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('fecha'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('fecha') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="pax" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Pax</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="number" class="form-control" id="pax" name="pax" value="{{ old('pax') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('pax'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('pax') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="overbooking" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Overbooking</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="number" class="form-control" id="overbooking" name="overbooking" value="{{ old('overbooking') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('overbooking'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('overbooking') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="pax_espera" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Pax espera</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="number" class="form-control" id="pax_espera" name="pax_espera" value="{{ old('pax_espera') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('pax_espera'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('pax_espera') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="horario_apertura" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Horario de apertura</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="time" class="form-control" id="horario_apertura" name="horario_apertura" value="{{ old('horario_apertura') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('horario_apertura'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('horario_apertura') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="horario_cierre" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Horario de cierre</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="time" class="form-control" id="horario_cierre" name="horario_cierre" value="{{ old('horario_cierre') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('horario_cierre'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('horario_cierre') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="profesores_sala" class="form-label offset-md-2 col-md-10 col-12">Profesores de sala</label>
                    @foreach ($profesoresSala as $profesor)
                        <div class="offset-md-3 col-md-7 col-12">
                            <label>
                                <input type="checkbox" name="profesores_sala[]" value="{{ $profesor->id }}">
                                {{ $profesor->nombre }} - {{ $profesor->tipo }}
                            </label>
                        </div>
                        <div class="col-md-2"></div>
                    @endforeach
                    @if ($errors->has('profesores_sala'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('profesores_sala') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                <label for="profesores_cocina" class="form-label offset-md-2 col-md-2 col-12">Profesores de cocina</label>
                    @foreach ($profesoresCocina as $profesor)
                        <div class="offset-md-3 col-md-7 col-12">
                                <input type="checkbox" name="profesores_cocina[]" value="{{ $profesor->id }}">
                                {{ $profesor->nombre }} - {{ $profesor->tipo }}
                        </div>
                        <div class="col-md-2"></div>
                    @endforeach
                    @if ($errors->has('profesores_cocina'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('profesores_cocina') }}
                        </div>
                    @endif
                </div>
                <div class="offset-md-4 offset-lg-3 col-md-8 col-lg-9 col-12 px-md-1 px-0">
                    <button type="submit" class="btn btn-success btn-fijo">Añadir</button>
                </div>
            </form>
        </div>
    </section>
