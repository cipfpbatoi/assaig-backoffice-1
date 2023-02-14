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
    <h4>Detalle de la Fecha {{$fecha->fecha}}</h4>
    <div class="border border-primary rounded shadow-lg p-3">
        <p><strong>Fecha:</strong> {{$fecha->fecha}}</p>
        <p><strong>Profesores asignados Cocina:</strong></p>
        <ul>
            @foreach($fecha->profesor_fecha_cocinas2 ?? [] as $profesor)
                <li>{{ $profesor->nombre }}</li>
            @endforeach
        </ul>

        <p><strong>Profesores asignados Sala</strong></p>
        <ul>
            @foreach($fecha->profesor_fecha_sala2 ?? [] as $profesor)
                <li>{{ $profesor->nombre }}</li>
            @endforeach
        </ul>

        <p><strong>Numero de Comensales Maximo:</strong> {{$fecha->pax}}</p>
        <p><strong>Overbooking: </strong>{{$fecha->overbooking}}</p>
        <p><strong>Numero de Comensales Esperados:</strong> {{$fecha->pax_espera}}</p>
        <p><strong>Hora de Apertura:</strong> {{$fecha->horario_apertura}}</p>
        <p><strong>Hora de Cierre:</strong> {{$fecha->horario_cierre}}</p>
    </div>
</div>
</body>
</html>
