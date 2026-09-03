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

    {{-- Sección: Los más vendidos (independiente, fuera de la fila de categorías) --}}
    @if($masVendidos->count() > 0)
        <div class="container-fluid py-4">
            <h2 class="text-white text-uppercase fw-bold mb-4">
                <i class="bi bi-trophy-fill text-warning me-2"></i> Los más vendidos
            </h2>

            <div class="row g-4">
                @foreach($masVendidos as $index => $item)
                    @if($item->producto)
                        <div class="col-md-4">
                            <div class="card bg-dark text-white border-0 rounded-4 shadow-lg h-100 position-relative">

                                <span class="position-absolute top-0 start-0 badge bg-warning text-dark fs-6 m-3 rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    {{ $index + 1 }}°
                                </span>

                                <div class="bg-black rounded-top-4 d-flex align-items-center justify-content-center p-3" style="height: 200px;">
                                    <img src="{{ $item->producto->url_imagen ? asset('storage/' . $item->producto->url_imagen) : 'https://via.placeholder.com/200' }}"
                                         class="img-fluid" style="max-height: 170px; object-fit: contain;"
                                         alt="{{ $item->producto->nombre }}">
                                </div>

                                <div class="card-body">
                                    <a href="{{ route('producto.show', $item->producto->id) }}" class="text-decoration-none">
                                        <h5 class="fw-bold text-white text-uppercase mb-2">{{ $item->producto->nombre }}</h5>
                                    </a>
                                    <p class="text-success fw-bold mb-0">
                                        {{ $item->total_vendido }} unidades vendidas
                                    </p>
                                    <h4 class="fw-bold text-white mt-2">
                                        ${{ number_format($item->producto->precio, 2, ',', '.') }}
                                    </h4>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    {{-- Sección: Statement de marca --}}
   <div class="position-relative text-white my-5" style="overflow: hidden; background-color: #000;">
    <img src="{{ asset('img/fondoPrincipal/estilo_vida2.jpg') }}"
         class="w-100"
         style="aspect-ratio: 21 / 7; object-fit: cover; object-position: right center; display: block;"
         alt="Nuestro estilo de vida">

    <div class="position-absolute top-50 start-0 translate-middle-y w-100">
        <div class="container">
            <div style="max-width: 480px;">
                <p class="text-white-50 text-uppercase mb-1" style="letter-spacing: 3px; font-size: 0.9rem;">
                    No es suplementación...
                </p>
                <h2 class="fw-bold text-success text-uppercase mb-0" style="font-size: 2.2rem; letter-spacing: 2px;">
                    Es nuestro estilo de vida
                </h2>
            </div>
        </div>
    </div>
</div>

    {{-- Sección: Categorías --}}
    <div class="container-fluid py-4">
        <div class="row g-3">
            @forelse($categorias as $cat)
                <div class="col-6 col-md-3">
                    <a class="secciones" href="{{ route('catalogo', $cat->id) }}">
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

    {{-- Sección: Productos destacados (últimos cargados) --}}
    <div class="container-fluid py-4">
        <h2 class="text-white text-uppercase fw-bold mb-4">Últimos productos</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($destacados as $producto)
                @include('secciones.tarjeta_producto', ['producto' => $producto])
            @empty
                <div class="col-12 text-center py-3">
                    <p class="text-muted small">Todavía no hay productos cargados.</p>
                </div>
            @endforelse
        </div>
    </div>

    @include('reseñas')

</main>
</div>
@endsection