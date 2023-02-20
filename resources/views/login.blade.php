@extends('layout.layout')

@section('content')
    <section class="row single-section mx-auto mb-5 bg-dark p-5 text-light">
        <div class="offset-md-1 col-md-11 col-12 my-3">
            <h2>Login Assaig Restaurante de CIP FP Batoi</h2>
        </div>
        <div class="col-12">
            <form action="{{ route('login') }}" class="mt-3" method="POST">
                @csrf
                @method('POST')
                <div class="row mb-3">
                    <label class="form-label offset-md-2 col-md-2 col-lg-1 col-12" for="email">Email:</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                <label for="password" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Contraseña:</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>
                @if (session('errors') && session('errors')->has('email'))
                    <div class="alert alert-danger">{{ session('errors')->first('email') }}</div>
                @endif
                    <div class="col-md-6 col-lg-7"></div>
                    <div class="offset-md-4 offset-lg-3 col-md-8 col-lg-9 col-12 px-md-1 px-0">
                        <button type="submit" class="btn btn-success btn-fijo">Enviar</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>
