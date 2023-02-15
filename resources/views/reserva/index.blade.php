<!DOCTYPE html>
<html>
<head>
    <title>Lista de Reservas</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<h1 class="text-uppercase font-weight-bold">Lista de Reservas</h1>
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
        @foreach($reservasPaginadas as $reserva)
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
                    <form action="{{route('reservas.update',  $reserva->id)}}" method="POST" class="justify-content-center mb-3" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary text-center">Confirmar</button>
                    </form>

                    <a class="btn btn-primary text-center mb-3" href="{{ route('reservas.show', $reserva->id) }}">Ver Mas</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="paginator d-flex justify-content-center my-3">
        @if(!$reservasPaginadas->onFirstPage())
            <a href="/reservas{{ $reservasPaginadas->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <span class="current-page mx-5">Pagina {{$reservasPaginadas->currentPage()}} de {{$reservasPaginadas->lastPage()}}</span>

        @if($reservasPaginadas->hasMorePages())
            <a href="/reservas{{ $reservasPaginadas->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif
    </div>
</div>
</body>
</html>
