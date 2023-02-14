<!DOCTYPE html>
<html>
<head>
    <title>Lista de Reservas</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<h1>Lista de Reservas</h1>
<div class="container">
    <table class="rounded shadow-lg table m-2 table-striped table-hover table-bordered text-center">
        <tr class="table-primary">
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Comensales</th>
            <th>Observaciones</th>
            <th>Localizador</th>
            <th>Confirmada</th>
            <th>Acción</th>
        </tr>
        @foreach($reservas as $reserva)
            <tr>
                <td>{{$reserva->nombre}}</td>
                <td>{{$reserva->email}}</td>
                <td>{{$reserva->telefono}}</td>
                <td>{{$reserva->comensales}}</td>
                <td>{{$reserva->observaciones}}</td>
                <td>{{$reserva->localizador}}</td>
                @if($reserva->confirmada === 1)
                    <td>Confrmada</td>
                @else
                    <td>Pendiente</td>
                @endif
                <td>
                    <form action="{{route('reserva.update',  $reserva->id)}}" method="POST" class="justify-content-center" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary text-center">Editar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="paginator d-flex justify-content-center my-3">
        @if(!$reservas->onFirstPage())
            <a href="{{ $reservas->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <span class="current-page mx-5">Pagina {{$reservas->currentPage()}} de {{$reservas->lastPage()}}</span>

        @if($reservas->hasMorePages())
            <a href="{{ $reservas->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif
    </div>
</div>
</body>
</html>
