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
<h4>Detalle de las reservas de la Fecha {{$date->fecha}}</h4>
<p>Fecha: {{$date->fecha}}</p>
<p>Numero de Comensales Maximo: {{$date->pax}}</p>
<p>Overbooking: {{$date->overbooking}}</p>
<p>Numero de pasajeros Esperados: {{$date->pax_esperado}}</p>
<p>Hora de Apertura: {{$date->horario_apertura}}</p>
<p>Hora de Cierre: {{$date->horario_cierre}}</p>


</body>
</html>
