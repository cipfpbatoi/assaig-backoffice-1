<?php $url_actual = Request::url(); ?>

<header class="row">
    <nav class="col-12 navbar navbar-expand-lg bg-dark navbar-dark fixed-top px-5">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="/img/logo.png" alt="Logo" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('fechas*') ? 'active' : '' }}" href="{{route('fechas.index')}}">FECHAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('reservas*') ? 'active' : '' }}" href="{{route('reservas.index')}}">RESERVAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profesores*') ? 'active' : '' }}" href="{{route('profesores.index')}}">PROFESORES</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
