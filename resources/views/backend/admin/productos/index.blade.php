@extends('layouts.app')

@section('main')

<div class="container-fluid py-4 text-white" style="background:#0d0f12; min-height:90vh;">
<div class="container">

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">

    <div>
        <h2 class="text-success fw-bold m-0">Gestión de Productos</h2>
        <small class="text-secondary">Alta, edición y control de stock</small>
    </div>

    <!-- BOTÓN VOLVER AL PANEL -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
        <i class="bi bi-speedometer2 me-1"></i> Panel Admin
    </a>

</div>

<!-- FORMULARIO -->
<div class="card bg-dark text-white border-secondary shadow-lg p-4 mb-5">

    <h5 class="text-success mb-3">Agregar Producto</h5>

    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <!-- NOMBRE -->
            <div class="col-md-6">
                <label class="text-light fw-bold">Nombre</label>
                <input type="text" name="nombre"
                       class="form-control bg-dark text-white border-secondary"
                       required>
            </div>

            <!-- PRECIO -->
            <div class="col-md-3">
                <label class="text-light fw-bold">Precio</label>
                <input type="number" step="0.01" name="precio"
                       class="form-control bg-dark text-white border-secondary"
                       required>
            </div>

            <!-- STOCK -->
            <div class="col-md-3">
                <label class="text-light fw-bold">Stock</label>
                <input type="number" name="stock"
                       class="form-control bg-dark text-white border-secondary"
                       required>
            </div>

            <!-- DESCRIPCIÓN -->
            <div class="col-12">
                <label class="text-light fw-bold">Descripción</label>
                <textarea name="descripcion"
                          class="form-control bg-dark text-white border-secondary"
                          rows="3"></textarea>
            </div>

            <!-- CATEGORÍA -->
            <div class="col-md-6">
                <label class="text-light fw-bold">Categoría</label>

                <select name="categoria_id"
                        class="form-select bg-dark text-white border-secondary"
                        required>

                    <option value="" selected disabled>
                        Seleccionar categoría...
                    </option>

                    <option value="1">Aumento de masa muscular</option>
                    <option value="2">Definición / Quemar grasa</option>
                    <option value="3">Salud y vitalidad</option>
                    <option value="4">Accesorios</option>

                </select>
            </div>

            <!-- IMAGEN -->
            <div class="col-md-6">
                <label class="text-light fw-bold">Imagen</label>
                <input type="file" name="url_imagen"
                       class="form-control bg-dark text-white border-secondary">
            </div>

            <!-- BOTÓN -->
            <div class="col-12 text-end mt-2">
                <button class="btn btn-success w-100 w-md-auto fw-bold">
                    Guardar Producto
                </button>
            </div>

        </div>
    </form>

</div>

<!-- TABLA -->
<div class="card bg-dark text-white border-secondary p-3">

    <h5 class="text-secondary mb-3">Productos registrados</h5>

    <div class="table-responsive">

        <table class="table table-dark table-hover align-middle">

            <thead>
                <tr class="text-secondary">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

            @forelse($productos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td class="fw-bold text-white">{{ $item->nombre }}</td>
                    <td>${{ $item->precio }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        @if($item->activo)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary py-4">
                        No hay productos cargados
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>
</div>

@endsection