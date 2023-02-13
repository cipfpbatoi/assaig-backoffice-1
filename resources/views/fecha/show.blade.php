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
<h4>Detalle de las reservas de la Fecha {{$fecha->fecha}}</h4>
<p>Fecha: {{$fecha->fecha}}</p>
<p>Profesores asignados Cocina</p>
<ul>
    @foreach($fecha->profesor_fecha_cocinas2 ?? [] as $profesor)
        <li>{{ $profesor->nombre }}</li>
    @endforeach
</ul>

<p>Profesores asignados Sala</p>
<ul>
    @foreach($fecha->profesor_fecha_sala2 ?? [] as $profesor)
        <li>{{ $profesor->nombre }}</li>
    @endforeach
</ul>

<p>Numero de Comensales Maximo: {{$fecha->pax}}</p>
<p>Overbooking: {{$fecha->overbooking}}</p>
<p>Numero de Comensales Esperados: {{$fecha->pax_espera}}</p>
<p>Hora de Apertura: {{$fecha->horario_apertura}}</p>
<p>Hora de Cierre: {{$fecha->horario_cierre}}</p>


</body>
</html>
