<!DOCTYPE html>
<html>
<head>
    <title>Lista de profesores</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<h1 class="text-uppercase font-weight-bold">Lista de profesores</h1>
<div class="container">
    <table class="rounded shadow-lg table m-2 table-striped table-hover table-bordered text-center">
        <tr class="table-primary">
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
        @foreach($profesores as $profesor)
            <tr>
                <td>{{$profesor->nombre}}</td>
                <td>{{$profesor->tipo}}</td>
                <td>
                    <a class="btn btn-primary text-center mb-3" href="{{ route('profesor.edit', $profesor->id) }}">Editar</a>
                </td>
            </tr>
        @endforeach

    </table>
    <a class="btn btn-primary text-center mb-3" href="{{ route('profesor.create') }}">Añadir Profesor</a>
    <div class="paginator d-flex justify-content-center my-3">
        @if(!$profesores->onFirstPage())
            <a href="{{ $profesores->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <span class="current-page mx-5">Pagina {{$profesores->currentPage()}} de {{$profesores->lastPage()}}</span>

        @if($profesores->hasMorePages())
            <a href="{{ $profesores->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif
    </div>
</div>
</body>
</html>
