@extends('layouts.app')

@section('main')
<div class="fondo-principal">
<main>
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

    <div class="container-fluid py-4">
        <div class="row g-3"> 
            
@forelse($categorias as $cat)
    <div class="col-6 col-md-3"> 
        {{-- Envía el ID real de la base de datos al catálogo --}}
        <a class="secciones" href="{{ route('catalogo.index', ['categoria' => $cat->id]) }}">
            
            {{-- Convertimos 'Salud y vitalidad' en 'salud-y-vitalidad' para la imagen --}}
            @php
                $nombreImagen = Str::slug($cat->nombre);
            @endphp

            <img src="{{ asset("img/fondoPrincipal/{$nombreImagen}.png")}}" class="img-fluid rounded shadow-sm" alt="{{ $cat->nombre }}">
        </a>
    </div>
@empty
    <div class="col-12 text-center py-3">
        <p class="text-muted small">No hay categorías disponibles para mostrar en este momento.</p>
    </div>
@endforelse
            
        </div>
    </div>

    @include('mas_vendidos')

    @include('reseñas')
    
</main>
</div>
@endsection