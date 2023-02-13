<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Fechas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>
<h4>Detalle de las Reservas </h4>
<p>Nombre: {{$reserva->nombre}}</p>
<p>Email: {{$reserva->email}}</p>
<p>Telefono: {{$reserva->telefono}}</p>
<p>Comensales: {{$reserva->comensales}}</p>
<p>Observaciones: {{$reserva->observaciones}}</p>
<p>Localizador: {{$reserva->localizador}}</p>

@if($reserva->confirmado)
    <p>La reserva esta confirmada</p>
@else
    <p>La reserva no esta conformada aun</p>
@endif
</body>
</html>
