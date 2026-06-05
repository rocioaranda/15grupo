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
                <button class="nav-link active rounded-pill fw-bold px-4 text-uppercase" id="todos-tab" data-bs-toggle="tab" data-bs-target="#tab-todos" type="button" role="tab" aria-controls="tab-todos" aria-selected="true">
                    Todos
                </button>
            </li>
            
            @foreach($categorias as $categoria)
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-bold px-4 text-uppercase text-white" id="cat-{{ $categoria->id }}-tab" data-bs-toggle="tab" data-bs-target="#tab-cat-{{ $categoria->id }}" type="button" role="tab" aria-controls="tab-cat-{{ $categoria->id }}" aria-selected="false">
                    {{ $categoria->nombre }}
                </button>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" id="catalogoTabsContent">
        
        <div class="tab-pane fade show active" id="tab-todos" role="tabpanel" aria-labelledby="todos-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse($productos as $producto)
                    @include('secciones.tarjeta_producto', ['producto' => $producto])
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted fs-5">No hay productos cargados en el catálogo actualmente.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @foreach($categorias as $categoria)
        <div class="tab-pane fade" id="tab-cat-{{ $categoria->id }}" role="tabpanel" aria-labelledby="cat-{{ $categoria->id }}-tab">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                
                @php
                    // Filtramos en tiempo real los productos que pertenezcan a esta categoría específica
                    $productosFiltrados = $productos->where('categoria_id', $categoria->id);
                @endphp

                @forelse($productosFiltrados as $producto)
                    @include('secciones.tarjeta_producto', ['producto' => $producto])
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


    