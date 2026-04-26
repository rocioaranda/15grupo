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
    <!-- 🛍️ CATÁLOGO -->
    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-4">Nuestro Catálogo</h2>
        
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
            
          <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/whey-protein-doypack.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">WHEY PROTEIN DOYPACK - 2 LBS STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$45.000</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;"> Comprar </a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/WheyProtein.jpeg') }}" class="card-img-top img-producto" alt="Producto 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">WHEY PLATINUM 2LB - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$50.000</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/GoldStandardProtein.jpeg') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">PROTEINA 100% GOLD STANDARD WHEY - OPTIMUM NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$85.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

</main>
</div>
@endsection