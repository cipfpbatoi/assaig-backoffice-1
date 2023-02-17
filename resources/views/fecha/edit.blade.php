<!DOCTYPE html>
<html>
<head>
    <title>Edit de Fechas</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<div class="container">
    <h4 class="text-uppercase font-weight-bold">Editado de la Fecha {{ $fecha->fecha }}</h4>
    <form action="{{ route('fechas.update', $fecha->id) }}" method="POST" enctype="multipart/form-data" class="border border-primary rounded shadow-lg p-3">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $fecha->fecha }}">
            @if ($errors->has('fecha'))
                <div class="text-danger">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="pax">Pax</label>
            <input type="number" name="pax" id="pax" class="form-control" value="{{ $fecha->pax }}">
            @if ($errors->has('pax'))
                <div class="text-danger">
                    {{ $errors->first('pax') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="overbooking">Overbooking</label>
            <input type="number" name="overbooking" id="overbooking" class="form-control" value="{{ $fecha->overbooking }}">
            @if ($errors->has('overbooking'))
                <div class="text-danger">
                    {{ $errors->first('overbooking') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="pax_espera">Pax Esperada</label>
            <input type="number" name="pax_espera" id="pax_espera" class="form-control" value="{{ $fecha->pax_espera }}">
            @if ($errors->has('pax_espera'))
                <div class="text-danger">
                    {{ $errors->first('pax_espera') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="horario_apertura">Horario de Apertura</label>
            <input type="time" name="horario_apertura" id="horario_apertura" class="form-control" value="{{ $horarioApertura }}">
            @if ($errors->has('horario_apertura'))
                <div class="text-danger">
                    {{ $errors->first('horario_apertura') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="horario_cierre">Horario de Cierre</label>
            <input type="time" name="horario_cierre" id="horario_cierre" class="form-control" value="{{ $horarioCierre }}">
            @if ($errors->has('horario_cierre'))
                <div class="text-danger">
                    {{ $errors->first('horario_cierre') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="horario_cierre">Profesores de Sala</label>
            @foreach ($profesores as $profesor)
                <div>
                    <label>
                        <input type="checkbox"
                               @if($profesor->tipo === 'sala')
                                   name="profesores_sala[]"
                               @elseif($profesor->tipo === 'cocina')
                                   name="profesores_cocina[]"
                               @endif


                               value="{{ $profesor->id }}"
                           @if(in_array($profesor->nombre, $profesoresSalaNombres) || in_array($profesor->nombre, $profesoresCocinaNombres))
                               checked
                            @endif
                        >

                        {{ $profesor->nombre }} - {{ $profesor->tipo }}
                    </label>
                </div>
            @endforeach

        </div>

        <input type="hidden" name="user_id" id="user_id" class="user_id" value="{{ Auth::user()->id ?? ''}}" min="0">

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">Editar</button>
        </div>
    </form>
</div>

</body>
</html>
