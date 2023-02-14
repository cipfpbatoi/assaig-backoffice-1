<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Fechas</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<div class="container">
    <h4>Nueva Fecha</h4>
    <form action="{{ route('fecha.store') }}" method="POST" enctype="multipart/form-data" class="border border-primary rounded shadow-lg p-3">
        @csrf
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="facha" class="form-control" value="{{ old('fecha') ?? ''}}">
            @if ($errors->has('fecha'))
                <div class="text-danger">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="pax">Pax</label>
            <input type="number" name="pax" id="pax" class="form-control" value="{{ old('pax') ?? ''}}">
            @if ($errors->has('pax'))
                <div class="text-danger">
                    {{ $errors->first('pax') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="overbooking">Overbooking</label>
            <input type="number" name="overbooking" id="overbooking" class="form-control" value="{{ old('overbooking') ?? ''}}">
            @if ($errors->has('overbooking'))
                <div class="text-danger">
                    {{ $errors->first('overbooking') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="pax_espera">Pax Esperada</label>
            <input type="number" name="pax_espera" id="pax_espera" class="form-control" value="{{ old('pax_espera') ?? ''}}">
            @if ($errors->has('pax_espera'))
                <div class="text-danger">
                    {{ $errors->first('pax_espera') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="horario_apertura">Horario de Apertura</label>
            <input type="time" name="horario_apertura" id="horario_apertura" class="form-control" value="{{ old('horario_apertura') ?? ''}}">
            @if ($errors->has('horario_apertura'))
                <div class="text-danger">
                    {{ $errors->first('horario_apertura') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="horario_cierre">Horario de Cierre</label>
            <input type="time" name="horario_cierre" id="horario_cierre" class="form-control" value="{{ old('horario_cierre') ?? ''}}">
            @if ($errors->has('horario_cierre'))
                <div class="text-danger">
                    {{ $errors->first('horario_cierre') }}
                </div>
            @endif
        </div>

        <input type="hidden" name="user_id" id="user_id" class="user_id" value="{{ Auth::user()->id ?? ''}}" min="0">

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">Añadir Nueva Fecha</button>
        </div>
    </form>
</div>




</body>
</html>
