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
        @foreach($datosPaginados as $profesor)
            <tr>
                <td>{{$profesor->nombre}}</td>
                <td>{{$profesor->tipo}}</td>
                <td>
                    <a class="btn btn-primary text-center mb-3" href="{{ route('profesores.edit', $profesor->id) }}">Editar</a>
                    <a class="btn btn-primary text-center mb-3" href="{{ route('profesores.destroy', $profesor->id) }}">Eliminar</a>
                </td>
            </tr>
        @endforeach

    </table>
    <a class="btn btn-primary text-center mb-3" href="{{ route('profesores.create') }}">Añadir Profesor</a>
    <div class="paginator d-flex justify-content-center my-3">
        @if(!$datosPaginados->onFirstPage())
            <a href="/profesores{{ $datosPaginados->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <span class="current-page mx-5">Pagina {{$datosPaginados->currentPage()}} de {{$datosPaginados->lastPage()}}</span>

        @if($datosPaginados->hasMorePages())
            <a href="/profesores{{ $datosPaginados->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif
    </div>
</div>
</body>
</html>
