@extends('layouts.app')

@section('main')
<main class="container py-5 my-5" style="background-color: #0d0f12; min-height: 80vh;">
    
    {{-- ===== ENCABEZADO DEL CATÁLOGO ===== --}}
    <div class="text-center mb-5">
        <h2 class="titulo-catalogo text-success fw-bold text-uppercase display-5">
            Nuestro Catálogo
        </h2>
        <p class="text-white-50">Explorá nuestros suplementos y accesorios para llevar tu entrenamiento al siguiente nivel.</p>
    </div>

{{-- ===== PESTAÑAS DE CATEGORÍAS (ENLACES) ===== --}}
    <div class="d-flex justify-content-center mb-5">
        <ul class="nav nav-pills bg-dark p-2 rounded-pill border border-secondary" role="tablist">
            
            <li class="nav-item" role="presentation">
                <a href="{{ route('catalogo') }}" 
                   class="nav-link rounded-pill fw-bold px-4 text-uppercase @if(!$categoriaId) active @endif">
                    Todos
                </a>
            </li>
            
            @foreach($categorias as $categoria)
            <li class="nav-item" role="presentation">
                <a href="{{ route('catalogo', $categoria->id) }}" 
                   class="nav-link rounded-pill fw-bold px-4 text-uppercase text-white @if($categoriaId == $categoria->id) active @endif">
                    {{ $categoria->nombre }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- ===== CONTENIDO DE PRODUCTOS Y PAGINACIÓN ===== --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" role="tabpanel">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                @forelse($productos as $producto)
                    <div class="col">
                        <div class="card h-100 bg-dark text-white border-secondary shadow-sm position-relative">

                            {{-- Badge de Categoría --}}
                            @if($producto->categoria)
                                <span class="position-absolute top-0 start-0 m-2 badge bg-secondary text-uppercase border border-light-50" style="font-size: 0.7rem; z-index: 2;">
                                    {{ $producto->categoria->nombre }}
                                </span>
                            @endif

                            <img src="{{ asset('storage/' . $producto->url_imagen) }}" 
                                 class="card-img-top p-3 rounded" 
                                 alt="{{ $producto->nombre }}" 
                                 style="height: 220px; object-fit: contain;">
                            
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-success fw-bold">{{ $producto->nombre }}</h5>

                                    <p class="card-text text-white-50 small" 
                                       id="desc-{{ $loop->index }}-{{ $producto->id }}">
                                        {{ Str::limit($producto->descripcion, 100, '...') }}
                                    </p>

                                    @if(strlen($producto->descripcion) > 100)
                                        <a href="#" 
                                           class="text-success small ver-mas-btn"
                                           data-full="{{ e($producto->descripcion) }}"
                                           data-target="desc-{{ $loop->index }}-{{ $producto->id }}">
                                            Ver más
                                        </a>
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <span class="fs-4 fw-bold text-white">${{ number_format($producto->precio, 2, ',', '.') }}</span>
                                    <p class="text-muted small mb-0">Stock: {{ $producto->stock }} u.</p>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                                @if(auth()->check() && Auth::user()->rol_id === 1)
                                    <button class="btn btn-secondary w-100 fw-bold" disabled>
                                        <i class="bi bi-lock-fill me-2"></i> Vista de Admin
                                    </button>
                                @elseif($producto->stock <= 0)
                                    <button class="btn btn-danger w-100 fw-bold" disabled>
                                        Sin Stock
                                    </button>
                                @else
                                    <form action="{{ route('carrito.agregar') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                        <input type="hidden" name="cantidad" value="1">
                                        <button type="submit" class="btn btn-outline-success w-100 fw-bold">
                                            <i class="bi bi-cart-plus me-2"></i> Agregar al carrito
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted fs-5">No hay productos disponibles en esta sección.</p>
                    </div>
                @endforelse
            </div>

            {{-- ===== ENLACES DE PAGINACIÓN ===== --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('ver-mas-btn')) {
        e.preventDefault();
        var parrafo = document.getElementById(e.target.getAttribute('data-target'));
        parrafo.textContent = e.target.getAttribute('data-full');
        e.target.remove();
    }
});
</script>

@endsection
