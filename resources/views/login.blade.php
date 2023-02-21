@extends('layout.layout')
@section('content')
    <section class="row single-section my-5 mx-auto mb-5 bg-dark p-5 text-light">
        <div class="offset-md-1 col-md-11 col-12 my-3">
            <h2>Login</h2>
        </div>
        <div class="col-12">
            <form class="mt-3" action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="email" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Email</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('email'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="password" class="form-label offset-md-2 col-md-2 col-lg-1 col-12">Contraseña</label>
                    <div class="col-md-6 col-lg-7 col-12">
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') ?? ''}}">
                    </div>
                    <div class="col-md-2"></div>
                    @if ($errors->has('password'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    @if (session('errors') && session('errors')->has('email'))
                        <div class="offset-md-3 col-md-9 col-12 text-danger">
                            {{ session('errors')->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-6 col-lg-7"></div>
                <div class="offset-md-4 offset-lg-3 col-md-8 col-lg-9 col-12 px-md-1 px-0">
                    <button type="submit" class="btn btn-success btn-fijo">Login</button>
                </div>
            </form>
        </div>
    </section>
