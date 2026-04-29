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
    <div class="container-fluid py-4">
    <div class="row g-3"> <div class="col-6 col-md-3"> <a class="secciones" href="{{ url('/Masa_aumento') }}">
                <img src="{{ asset('img/fondoPrincipal/1.png') }}" class="img-fluid" alt="Aumento de masa">
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a class="secciones" href="{{ url('/quemar_grasa') }}">
                <img src="{{ asset('img/fondoPrincipal/3.png') }}" class="img-fluid" alt="quemador de grasa">
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a class="secciones" href="{{ url('/vitalidad_salud') }}">
                <img src="{{ asset('img/fondoPrincipal/2.png') }}" class="img-fluid" alt="salud y vitalidad">
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a class="secciones" href="{{ url('/acce') }}">
                <img src="{{ asset('img/fondoPrincipal/4.png') }}" class="img-fluid" alt="accesorios">
            </a>
        </div>
        
    </div>
</div>

    @include('mas_vendidos')

    @include('reseñas')
    
</main>
</div>
@endsection