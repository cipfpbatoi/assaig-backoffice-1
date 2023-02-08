<!DOCTYPE html>
<html>
<head>
    <title>Lista de profesores</title>
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
<h1>Lista de profesores</h1>
<table>
    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
    </tr>
    @foreach($profesores as $profesor)
        <tr>
            <td>{{$profesor->nombre}}</td>
            <td>{{$profesor->tipo}}</td>
        </tr>
    @endforeach


</table>
</body>
</html>
