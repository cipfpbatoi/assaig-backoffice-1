<!DOCTYPE html>
<html>
<head>
    <title>Lista de Fechas</title>
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
<h1>Lista de Reservas</h1>
<table>
    <tr>
        <th>Fecha</th>
        <th>Pax</th>
        <th>Overbooking</th>
        <th>pax_espera</th>
        <th>horario_apertura</th>
        <th>horario_cierre	</th>
    </tr>
    @foreach($dates as $date)
        <tr>
            <td>{{$date->fecha}}</td>
            <td>{{$date->pax}}</td>
            <td>{{$date->overbooking}}</td>
            <td>{{$date->pax_espera}}</td>
            <td>{{$date->horario_apertura}}</td>
            <td>{{$date->horario_cierre}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
