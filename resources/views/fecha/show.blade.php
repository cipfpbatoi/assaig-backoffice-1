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
    <h4 class="text-uppercase font-weight-bold">Profesores Asignados a la fecha {{$fecha->fecha}}</h4>
    <div class="border border-primary rounded shadow-lg p-3">

        <p><strong>Profesores asignados Cocina:</strong></p>
        <ul>
            @foreach($fecha->profesores_cocina ?? [] as $profesor)
                <li>{{ $profesor->nombre }}</li>
            @endforeach
        </ul>

        <p><strong>Profesores asignados Sala</strong></p>
        <ul>
            @foreach($fecha->profesores_sala ?? [] as $profesor)
                <li>{{ $profesor->nombre }}</li>
            @endforeach
        </ul>

    </div>
</div>
</body>
</html>
