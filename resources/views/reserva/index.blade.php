<!DOCTYPE html>
<html>
<head>
    <title>Lista de Reservas</title>
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
        <th>Nombre</th>
        <th>Email</th>
        <th>Telefono</th>
        <th>Comensales</th>
        <th>Observaciones</th>
        <th>Localizador</th>
    </tr>
    @foreach($reservas as $reserva)
        <tr>
            <td>{{$reserva->nombre}}</td>
            <td>{{$reserva->email}}</td>
            <td>{{$reserva->telefono}}</td>
            <td>{{$reserva->comensales}}</td>
            <td>{{$reserva->observaciones}}</td>
            <td>{{$reserva->localizador}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
