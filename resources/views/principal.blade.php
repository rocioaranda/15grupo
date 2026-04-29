@extends('layouts.app')

@section('main')
<div class="fondo-principal">
<main>
     <!-- 🎠 CARRUSEL -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/carrousel/prueba1.png') }}" class="d-block w-100" alt="Promoción 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carrousel/prueba2.png') }}" class="d-block w-100" alt="Promoción 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carrousel/prueba3.png') }}" class="d-block w-100" alt="Promoción 3">
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
    <!-- divisiones-->
    <div class="contenedor-secciones">

    <a class="nav-link secciones" href="{{ url('/aumento_masa') }}" style="text-decoration:none;">
        <img src="{{ asset('img/fondoPrincipal/1.png') }}" alt="Aumento de masa">
    </a>

    <a class="nav-link secciones" href="{{ url('/quemar_grasa') }}" style="text-decoration:none;">
        <img src="{{ asset('img/fondoPrincipal/3.png') }}" alt="quemador de grasa">
    </a>

    <a class="nav-link secciones" href="{{ url('/salud_vitalidad') }}" style="text-decoration:none;">
            <img src="{{ asset('img/fondoPrincipal/2.png') }}" alt="salud y vitalidad">
        </a>

     <a class="nav-link secciones" href="{{ url('/accesorios') }}" style="text-decoration:none;">
            <img src="{{ asset('img/fondoPrincipal/4.png') }}" alt="accesorios">
        </a>

    </div>

    @include('mas_vendidos')

    @include('reseñas')
    
</main>
</div>
@endsection