<!DOCTYPE html>
<html>
<head>
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<div class="container w-50 mt-5">
    <h4 class="text-uppercase font-weight-bold">Editar Reserva</h4>
    <form action="{{ route('reservas.update', $reserva) }}" method="POST" enctype="multipart/form-data" class="border border-primary rounded shadow-lg p-3">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $reserva->fecha->fecha }}" required>
            @if ($errors->has('fecha'))
                <div class="text-danger">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $reserva->nombre }}" minlength="5" required>
            @if ($errors->has('nombre'))
                <div class="text-danger">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $reserva->email }}" required>
            @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" name="telefono" id="telefono" class="form-control" value="{{ $reserva->telefono }}" required>
            @if ($errors->has('telefono'))
                <div class="text-danger">
                    {{ $errors->first('telefono') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="comensales">Comensales</label>
            <input class="inputStyle" type="number" step="1" min="1" name="comensales" id="comensales" class="form-control" value="{{ $reserva->comensales }}" required>
            @if ($errors->has('comensales'))
                <div class="text-danger">
                    {{ $errors->first('comensales') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="localizador">Localizador</label>
            <input type="text" name="localizador" id="localizador" class="form-control" value="{{ $reserva->localizador }}" required>
            @if ($errors->has('localizador'))
                <div class="text-danger">
                    {{ $errors->first('localizador') }}
                </div>
            @endif
        </div>
        <div class="form-group">
        @foreach($alergenos as $alergeno)
            <label>
                <input type="checkbox" name="alergenos[]" value="{{ $alergeno->id }}" {{ in_array($alergeno->id, $reserva->alergenos) ? 'checked' : '' }}>
                {{ $alergeno->nombre }}
            </label>
        @endforeach
        </div>
        <div class="form-group">
            <label for="confirmada">Confirmada</label>
            <input type="checkbox" name="confirmada" id="confirmada" class="form-control" {{$reserva->confirmada ? 'checked' : ''}}>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">Editar Reserva</button>
        </div>
    </form>
</div>




</body>
</html>
