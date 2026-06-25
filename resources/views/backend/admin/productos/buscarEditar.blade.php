@extends('layouts.app')

@section('main')

<div class="container py-4">

    <h4 class="fw-bold text-warning mb-4">
        @if(session('exito'))
    <div class="alert alert-success">{{ session('exito') }}</div>
    @endif
        Buscar Producto para Editar
    </h4>

    <div class="card bg-dark text-white border-secondary mb-4">
        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.productos.buscarEditar') }}">

                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">ID</label>
                        <input type="number"
                               name="id"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ request('id') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text"
                               name="nombre"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ request('nombre') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Categoría</label>

                        <select name="categoria_id"
                                class="form-select bg-dark text-white border-secondary">

                            <option value="">Todas</option>

                            @foreach($categorias as $categoria)

                                <option value="{{ $categoria->id }}"
                                    {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>

                                    {{ $categoria->nombre }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit"
                                class="btn btn-warning w-100">
                            Buscar
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="card bg-dark text-white border-secondary">
        <div class="card-body">

            <h5 class="mb-3">
                Resultados
            </h5>

            <div class="table-responsive">

                <table class="table table-dark table-striped align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($productos as $producto)

                            <tr>

                                <td>{{ $producto->id }}</td>

                                <td>{{ $producto->nombre }}</td>

                                <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>

                                <td>${{ number_format($producto->precio, 2, ',', '.') }}</td>

                                <td>{{ $producto->stock }}</td>

                                <td>

                                    <a href="{{ route('admin.productos.edit', $producto->id) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="bi bi-pencil-square"></i>
                                        Editar

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No se encontraron productos.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                <a href="/admin"
                   class="btn btn-outline-light">

                    <i class="bi bi-arrow-left"></i>
                    Volver al Panel

                </a>
            </div>

        </div>
    </div>

</div>

@endsection