@extends('layouts.app')

@section('main')
<div class="container py-4">

    <h4 class="fw-bold text-danger mb-4">Eliminar Producto</h4>

    {{-- ALERTAS --}}
    @if(session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card bg-dark text-white border-secondary">
        <div class="card-body">

            {{-- ================= FILTROS ================= --}}
            <h6 class="text-secondary mb-3">Filtrar productos</h6>

            <form action="{{ route('admin.productos.eliminar') }}" method="GET">
                <div class="row g-3 mb-4">

                    <div class="col-md-3">
                        <label class="form-label">ID</label>
                        <input type="number" name="id"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ request('id') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre"
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
                        <button class="btn btn-outline-warning w-100">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                    </div>

                </div>
            </form>

            {{-- ================= RESULTADOS ================= --}}
            @if($productos !== null)

                @if($productos->isEmpty())
                    <div class="alert alert-secondary">
                        No se encontraron productos.
                    </div>
                @else

                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle mb-0">

                            <thead class="border-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($productos as $producto)
                                    <tr>
                                        <td class="text-secondary">{{ $producto->id }}</td>

                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if($producto->url_imagen)
                                                    <img src="{{ asset('storage/' . $producto->url_imagen) }}"
                                                         width="38" height="38"
                                                         class="rounded"
                                                         style="object-fit:cover;">
                                                @endif
                                                {{ $producto->nombre }}
                                            </div>
                                        </td>

                                        <td class="text-secondary">
                                            {{ $producto->categoria->nombre ?? '-' }}
                                        </td>

                                        <td>${{ number_format($producto->precio, 2) }}</td>
                                        <td>{{ $producto->stock }}</td>

                                        <td>
                                            @if($producto->activo)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-secondary">Inactivo</span>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <button class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar"
                                                    data-id="{{ $producto->id }}"
                                                    data-nombre="{{ $producto->nombre }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                @endif

            @else
                <p class="text-secondary mb-0">
                    Usá los filtros para buscar productos.
                </p>
            @endif

            {{-- BOTÓN --}}
            <div class="d-flex justify-content-end mt-4">
                <a href="/admin" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left"></i> Volver al Panel
                </a>
            </div>

        </div>
    </div>
</div>

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border-secondary">

            <div class="modal-header border-secondary">
                <h5 class="modal-title text-danger">Confirmar eliminación</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>
                    ¿Eliminar el producto
                    <strong id="modalNombreProducto"></strong>?
                </p>
                <small class="text-secondary">
                    Esta acción no se puede deshacer.
                </small>
            </div>

            <div class="modal-footer border-secondary">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <form id="formEliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        Eliminar
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
const baseUrl = "{{ url('admin/productos') }}";
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('modalEliminar').addEventListener('show.bs.modal', (event) => {
        const id = event.relatedTarget.getAttribute('data-id');
        const nombre = event.relatedTarget.getAttribute('data-nombre');
        document.getElementById('modalNombreProducto').textContent = nombre;
        document.getElementById('formEliminar').action = baseUrl + '/' + id;
    });
});
</script>

@endsection