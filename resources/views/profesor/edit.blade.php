<!DOCTYPE html>
<html>
<head>
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>
<body>
@include('layout.navegation')
<div class="container w-50 mt-5">
    <h4>Editar Profesor</h4>
    <form action="{{ route('profesor.update', $profesor->id) }}" method="POST" enctype="multipart/form-data" class="border border-primary rounded shadow-lg p-3">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $profesor->nombre }}">
            @if ($errors->has('nombre'))
                <div class="text-danger">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
        </div>

        <div class="form-group mt-2">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo">
                <option value="Sala">Sala</option>
                <option value="Cocina">Cocina</option>
                @if ($profesor->tipo === 'sala')
                    <option value="Sala" selected>Sala</option>
                    <option value="Cocina">Cocina</option>
                @else
                    <option value="Sala">Sala</option>
                    <option value="Cocina" selected>Cocina</option>
                @endif
            </select>
        </div>


        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">Añadir Profesor</button>
        </div>
    </form>
</div>




</body>
</html>
