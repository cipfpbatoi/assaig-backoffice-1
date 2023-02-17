<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Reserva</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<div class="container">
    <h4 class="text-uppercase font-weight-bold">Detalle de las Reservas </h4>
    <div class="border border-primary rounded shadow-lg p-3 w-50">
        <p>Nombre: {{$reserva->nombre}}</p>
        <p>Email: {{$reserva->email}}</p>
        <p>Telefono: {{$reserva->telefono}}</p>
        <p>Comensales: {{$reserva->comensales}}</p>
        <p>Observaciones: {{$reserva->observaciones}}</p>
        <p>Localizador: {{$reserva->localizador}}</p>

        <p>Listado Alergenos</p>
        <ul>
            @foreach($reserva->alergenos ?? [] as $alergeno)
                <li>{{ $alergeno->nombre }}</li>
            @endforeach
        </ul>


        @if($reserva->confirmada)
            <p>La reserva esta confirmada</p>
        @else
            <p>No esta conformada aun la reserva</p>
        @endif
    </div>
</div>
</body>
</html>
