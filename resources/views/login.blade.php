
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-6 mx-auto d-flex justify-content-center">
                <form action="{{ route('login') }}" class="pt-5 w-50" method="POST">
                    @csrf
                    @method('POST')
                    <h3>Login del BackOffice de Assaig Restaurante de CIP FP Batoi</h3>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control">

                    @if (session('errors') && session('errors')->has('email'))
                        <div class="alert alert-danger">{{ session('errors')->first('email') }}</div>
                    @endif

                    <button type="submit" class="btn btn-primary btn-block mb-4">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
