@extends('layouts.app')

@section('main')
<main class="container py-5 my-5" style="background-color: #0d0f12; min-height: 80vh;">
    
    <div class="text-center mb-5">
        <h2 class="titulo-catalogo text-success fw-bold text-uppercase display-5">
            Nuestro Catálogo
        </h2>
        <p class="text-white-50">Explorá nuestros suplementos y accesorios para llevar tu entrenamiento al siguiente nivel.</p>
    </div>

    <div class="d-flex justify-content-center mb-5">
        <ul class="nav nav-pills bg-dark p-2 rounded-pill border border-secondary" id="catalogoTabs" role="tablist">
            
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold px-4 text-uppercase @if(!$categoriaId) active @endif" 
                        id="todos-tab" data-bs-toggle="tab" data-bs-target="#tab-todos" type="button" role="tab" aria-controls="tab-todos" 
                        aria-selected="@if(!$categoriaId) true @else false @endif">
                    Todos
                </button>
            </li>
            
            @foreach($categorias as $categoria)
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold px-4 text-uppercase text-white @if($categoriaId == $categoria->id) active @endif" 
                        id="cat-{{ $categoria->id }}-tab" data-bs-toggle="tab" data-bs-target="#tab-cat-{{ $categoria->id }}" type="button" role="tab" aria-controls="tab-cat-{{ $categoria->id }}" 
                        aria-selected="@if($categoriaId == $categoria->id) true @else false @endif">
                    {{ $categoria->nombre }}
                </button>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" id="catalogoTabsContent">
        
        <div class="tab-pane fade @if(!$categoriaId) show active @endif" id="tab-todos" role="tabpanel" aria-labelledby="todos-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse($productos as $producto)
                    <div class="col">
                        <div class="card h-100 bg-dark text-white border-secondary shadow-sm position-relative">
                            
                            @if($producto->categoria)
                                <span class="position-absolute top-0 start-0 m-2 badge bg-secondary text-uppercase border border-light-50" style="font-size: 0.7rem; z-index: 2;">
                                    {{ $producto->categoria->nombre }}
                                </span>
                            @endif

                            <img src="{{ asset('storage/' . $producto->url_imagen) }}" class="card-img-top p-3 rounded" alt="{{ $producto->nombre }}" style="height: 220px; object-fit: contain;">
                            
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-success fw-bold">{{ $producto->nombre }}</h5>
                                    <p class="card-text text-white-50 small">{{ Str::limit($producto->descripcion, 60, '...') }}</p>
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
                        <p class="text-muted fs-5">No hay productos cargados en el catálogo actualmente.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @foreach($categorias as $categoria)
        <div class="tab-pane fade @if($categoriaId == $categoria->id) show active @endif" id="tab-cat-{{ $categoria->id }}" role="tabpanel" aria-labelledby="cat-{{ $categoria->id }}-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                
                @php
                    // 🔥 SOLUCIÓN: Filtramos la colección de productos comparándola con el ID de la categoría actual del bucle
                    $productosFiltrados = $productos->where('categoria_id', $categoria->id);
                @endphp

                @forelse($productosFiltrados as $producto)
                    <div class="col">
                        <div class="card h-100 bg-dark text-white border-secondary shadow-sm position-relative">
                            
                            @if($producto->categoria)
                                <span class="position-absolute top-0 start-0 m-2 badge bg-secondary text-uppercase border border-light-50" style="font-size: 0.7rem; z-index: 2;">
                                    {{ $producto->categoria->nombre }}
                                </span>
                            @endif

                            <img src="{{ asset('storage/' . $producto->url_imagen) }}" class="card-img-top p-3 rounded" alt="{{ $producto->nombre }}" style="height: 220px; object-fit: contain;">
                            
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-success fw-bold">{{ $producto->nombre }}</h5>
                                    <p class="card-text text-white-50 small">{{ Str::limit($producto->descripcion, 60, '...') }}</p>
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
                        <p class="text-muted fs-5">Próximamente stock disponible en {{ $categoria->nombre }}.</p>
                    </div>
                @endforelse

            </div>
        </div>
        @endforeach

    </div>
</main>
@endsection


    