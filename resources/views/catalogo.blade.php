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

    {{-- ===== PESTAÑAS DE CATEGORÍAS =====
         Cada botón activa un panel distinto usando Bootstrap Tabs.
         La clase "active" se asigna dinámicamente según la categoría seleccionada.
         Si $categoriaId es null, se activa "Todos" por defecto. --}}
    <div class="d-flex justify-content-center mb-5">
        <ul class="nav nav-pills bg-dark p-2 rounded-pill border border-secondary" id="catalogoTabs" role="tablist">
            
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold px-4 text-uppercase @if(!$categoriaId) active @endif" 
                        id="todos-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#panel-todos" 
                        type="button" 
                        role="tab" 
                        aria-controls="panel-todos" 
                        aria-selected="@if(!$categoriaId) true @else false @endif">
                    Todos
                </button>
            </li>
            
            {{-- Generamos una pestaña por cada categoría que exista en la base de datos --}}
            @foreach($categorias as $categoria)
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold px-4 text-uppercase text-white @if($categoriaId == $categoria->id) active @endif" 
                        id="pestana-cat-{{ $categoria->id }}" 
                        data-bs-toggle="tab" 
                        data-bs-target="#panel-cat-{{ $categoria->id }}" 
                        type="button" 
                        role="tab" 
                        aria-controls="panel-cat-{{ $categoria->id }}" 
                        aria-selected="@if($categoriaId == $categoria->id) true @else false @endif">
                    {{ $categoria->nombre }}
                </button>
            </li>
            @endforeach
        </ul>
    </div>

    {{-- ===== CONTENIDO DE LAS PESTAÑAS ===== --}}
    <div class="tab-content" id="catalogoTabsContent">
        
        {{-- ===== PANEL "TODOS" =====
             Muestra todos los productos activos sin filtrar por categoría.
             $productos viene del CatalogoController con where('activo', true). --}}
        <div class="tab-pane fade @if(!$categoriaId) show active @endif" id="panel-todos" role="tabpanel" aria-labelledby="todos-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                {{-- @forelse muestra productos si hay, o el @empty si la colección está vacía --}}
                @forelse($productos as $producto)
                    <div class="col">
                        <div class="card h-100 bg-dark text-white border-secondary shadow-sm position-relative">

                            {{-- Badge con el nombre de la categoría del producto --}}
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

                                    {{-- ===== DESCRIPCIÓN CON "VER MÁS" =====
                                         Usamos $loop->index (índice del foreach) combinado con $producto->id
                                         para generar un ID único por tarjeta y evitar conflictos
                                         entre el panel Todos y los paneles de categoría.
                                         data-full guarda la descripción completa en el HTML
                                         sin necesidad de hacer otra petición al servidor. --}}
                                    <p class="card-text text-white-50 small" 
                                       id="desc-todos-{{ $loop->index }}-{{ $producto->id }}">
                                        {{ Str::limit($producto->descripcion, 100, '...') }}
                                    </p>

                                    {{-- Solo muestra el link "Ver más" si la descripción supera 100 caracteres --}}
                                    @if(strlen($producto->descripcion) > 100)
                                        <a href="#" 
                                           class="text-success small ver-mas-btn"
                                           data-full="{{ e($producto->descripcion) }}"
                                           data-target="desc-todos-{{ $loop->index }}-{{ $producto->id }}">
                                            Ver más
                                        </a>
                                    @endif

                                </div>
                                <div class="mt-3">
                                    <span class="fs-4 fw-bold text-white">${{ number_format($producto->precio, 2, ',', '.') }}</span>
                                    <p class="text-muted small mb-0">Stock: {{ $producto->stock }} u.</p>
                                </div>
                            </div>
                            
                            {{-- ===== BOTÓN DE ACCIÓN =====
                                 Tres casos posibles:
                                 1. El usuario es admin → muestra botón bloqueado
                                 2. No hay stock → muestra "Sin Stock"
                                 3. Usuario normal con stock → muestra "Agregar al carrito" --}}
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
                        <p class="text-muted fs-5">No hay productos cargados actualmente.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ===== PANELES POR CATEGORÍA =====
             Por cada categoría generamos un panel separado.
             Filtramos $productos (ya cargados) por categoria_id en PHP
             para no hacer consultas extra a la base de datos. --}}
        @foreach($categorias as $categoria)
        <div class="tab-pane fade @if($categoriaId == $categoria->id) show active @endif" 
             id="panel-cat-{{ $categoria->id }}" 
             role="tabpanel" 
             aria-labelledby="pestana-cat-{{ $categoria->id }}">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                
                {{-- Filtramos la colección en memoria, sin nueva consulta SQL --}}
                @php
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

                            <img src="{{ asset('storage/' . $producto->url_imagen) }}" 
                                 class="card-img-top p-3 rounded" 
                                 alt="{{ $producto->nombre }}" 
                                 style="height: 220px; object-fit: contain;">
                            
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title text-success fw-bold">{{ $producto->nombre }}</h5>

                                    {{-- Prefijo "cat" para diferenciar estos IDs de los del panel Todos --}}
                                    <p class="card-text text-white-50 small" 
                                       id="desc-cat-{{ $loop->index }}-{{ $producto->id }}">
                                        {{ Str::limit($producto->descripcion, 100, '...') }}
                                    </p>

                                    @if(strlen($producto->descripcion) > 100)
                                        <a href="#" 
                                           class="text-success small ver-mas-btn"
                                           data-full="{{ e($producto->descripcion) }}"
                                           data-target="desc-cat-{{ $loop->index }}-{{ $producto->id }}">
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
                        <p class="text-muted fs-5">Próximamente stock disponible en {{ $categoria->nombre }}.</p>
                    </div>
                @endforelse

            </div>
        </div>
        @endforeach

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

@push('scripts')
<script>
    // ===== LÓGICA DE LAS PESTAÑAS CON BUSCADOR =====
    // Si el usuario llegó al catálogo desde el buscador del navbar (param ?buscar=...)
    // y no hay una categoría específica seleccionada, forzamos la pestaña "Todos" como activa.
    let categoriaId = "{{ $categoriaId }}";
    let tieneBusqueda = "{{ request('buscar') }}";

    if (tieneBusqueda && !categoriaId) {
        let todosTab = document.getElementById('todos-tab');
        let todosPanel = document.getElementById('panel-todos');
        
        if (todosTab && todosPanel) {
            // Limpiamos cualquier pestaña activa residual
            document.querySelectorAll('#catalogoTabs .nav-link').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('#catalogoTabsContent .tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
            
            // Activamos la pestaña "Todos"
            todosTab.classList.add('active');
            todosTab.setAttribute('aria-selected', 'true');
            todosPanel.classList.add('show', 'active');
        }
    }

});
</script>
@endpush
