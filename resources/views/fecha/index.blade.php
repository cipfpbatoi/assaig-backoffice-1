<!DOCTYPE html>
<html>
<head>
    <title>Lista de Fechas</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<h1 class="text-uppercase font-weight-bold">Lista de Fechas</h1>
<div class="container">
    <table class="rounded table m-2 table-striped table-hover table-bordered text-center shadow-lg">
        <tr class="table-primary">
            <th scope="col">Fecha</th>
            <th scope="col">Pax</th>
            <th scope="col">Overbooking</th>
            <th scope="col">pax_espera</th>
            <th scope="col">horario_apertura</th>
            <th scope="col">horario_cierre	</th>
            <th scope="col">Accion	</th>
        </tr>
        <tbody>
        @foreach($datesPaginadas as $date)
            <tr>
                <td>{{$date->fecha}}</td>
                <td>{{$date->pax}}</td>
                <td>{{$date->overbooking}}</td>
                <td>{{$date->pax_espera}}</td>
                <td>{{$date->horario_apertura}}</td>
                <td>{{$date->horario_cierre}}</td>
                <td>
                    <a class="btn btn-primary text-center mb-3" href="{{ route('fechas.show', $date->id) }}">Ver Mas</a>
                    <a class="btn btn-primary text-center mb-3" href="{{ route('fechas.edit', $date->id) }}">Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary text-center mb-3" href="{{ route('fechas.create') }}">Añadir Fecha</a>
    <div class="paginator d-flex justify-content-center my-3">
        @if(!$datesPaginadas->onFirstPage())
            <a href="{{ $datesPaginadas->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <span class="current-page mx-5">Pagina {{$datesPaginadas->currentPage()}} de {{$datesPaginadas->lastPage()}}</span>

        @if($datesPaginadas->hasMorePages())
            <a href="{{ $datesPaginadas->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif
    </div>
</div>

</body>
</html>
