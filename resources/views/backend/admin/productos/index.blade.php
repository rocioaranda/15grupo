@extends('layouts.app')

@section('main')
<div class="container-fluid py-4 py-md-5 text-white" style="background-color: #0d0f12; min-height: 90vh;">
    <div class="container">
        
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4 mb-md-5 border-bottom border-secondary pb-3">
            <div>
                <h1 class="fw-bold text-success m-0 fs-2 fs-md-1">Gestión de Productos</h1>
                <p class="text-muted m-0 mt-1 small">Alta, baja y modificación del catálogo de suplementos</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm shadow-none w-100 w-sm-auto">
                <i class="bi bi-arrow-left me-1"></i> Volver al Panel
            </a>
        </div>

        <div class="card bg-dark text-white border-0 shadow-lg p-3 p-md-4 mb-4 mb-md-5">
            <h5 class="fw-bold text-success mb-4"><i class="bi bi-plus-circle me-2"></i>Agregar Nuevo Producto</h5>
            
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label small text-muted text-uppercase fw-bold">Nombre del Producto</label>
                        <input type="text" name="nombre" class="form-control bg-transparent border-secondary text-white p-2 shadow-none" placeholder="Ej: Proteína Whey 1kg" required>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Precio ($)</label>
                        <input type="number" step="0.01" name="precio" class="form-control bg-transparent border-secondary text-white p-2 shadow-none" placeholder="0.00" required>
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label small text-muted text-uppercase fw-bold">Cantidad (Stock)</label>
                        <input type="number" name="stock" class="form-control bg-transparent border-secondary text-white p-2 shadow-none" placeholder="0" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label small text-muted text-uppercase fw-bold">Imagen del Producto</label>
                        <input type="file" name="url_imagen" class="form-control bg-transparent border-secondary text-white shadow-none" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label small text-muted text-uppercase fw-bold">Categoría de Enfoque</label>
                        <select name="categoria_id" class="form-select bg-dark border-secondary text-white p-2 shadow-none" required>
                            <option value="" selected disabled hidden>Seleccionar categoría...</option>
                            <option value="1">Aumento de masa muscular</option>
                            <option value="2">Definición / Quemar grasa</option>
                            <option value="3">Salud y vitalidad</option>
                            <option value="4">Accesorios</option>
                        </select>
                    </div>
                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-success fw-bold px-4 shadow-none w-100 w-sm-auto">
                            <i class="bi bi-check-lg me-1"></i> Guardar Producto
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card bg-dark text-white border-0 shadow-lg p-3 p-md-4">
            <h5 class="fw-bold text-muted mb-4"><i class="bi bi-list-ul me-2"></i>Artículos en Catálogo</h5>
            
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle m-0" style="min-width: 750px;">
                    <thead>
                        <tr class="text-muted border-secondary small text-uppercase">
                            <th style="width: 60px;">ID</th>
                            <th style="width: 250px;">Nombre del Producto</th>
                            <th style="width: 150px;">Precio ($)</th>
                            <th style="width: 130px;">Cantidad</th>
                            <th style="width: 140px;">Estado</th>
                            <th class="text-end" style="width: 150px;">Acciones de CRUD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $item)
                            <tr class="border-secondary">
                                <td class="fw-bold text-muted">{{ $item->id }}</td>
                                
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($item->url_imagen)
                                            <img src="{{ asset('storage/' . $item->url_imagen) }}" alt="Img" class="rounded border border-secondary flex-shrink-0" style="width: 45px; height: 45px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-dark flex-shrink-0" style="width: 45px; height: 45px;">
                                                <i class="bi bi-image small"></i>
                                            </div>
                                        @endif
                                        <div class="w-100">
                                            <input type="text" form="form-update-{{ $item->id }}" name="nombre" value="{{ $item->nombre }}" class="form-control form-control-sm bg-transparent border-0 text-white fw-bold p-0 shadow-none focus-border-bottom" style="border-radius: 0;" required>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-transparent border-secondary text-success">$</span>
                                        <input type="number" step="0.01" form="form-update-{{ $item->id }}" name="precio" value="{{ $item->precio }}" class="form-control bg-transparent border-secondary text-white text-end px-2 shadow-none fw-bold" required>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input type="number" form="form-update-{{ $item->id }}" name="stock" value="{{ $item->stock }}" class="form-control bg-transparent border-secondary text-white text-center shadow-none {{ $item->stock > 0 ? 'text-white' : 'text-danger fw-bold' }}" min="0" required>
                                        <span class="input-group-text bg-transparent border-secondary text-muted small">un.</span>
                                    </div>
                                </td>
                                
                                <td>
                                    @if($item->trashed())
                                        <span class="badge bg-danger bg-opacity-25 text-danger border border-danger w-100 text-center py-1 small">Baja Lógica</span>
                                    @else
                                        <select form="form-update-{{ $item->id }}" name="activo" class="form-select form-select-sm bg-transparent border-secondary text-white shadow-none fw-bold">
                                            <option value="1" class="bg-dark text-success" {{ $item->activo ? 'selected' : '' }}>Activo</option>
                                            <option value="0" class="bg-dark text-danger" {{ !$item->activo ? 'selected' : '' }}>Inactivo</option>
                                        </select>
                                    @endif
                                </td>
                                
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        @if(!$item->trashed())
                                            <form id="form-update-{{ $item->id }}" action="{{ route('admin.productos.update', $item->id) }}" method="POST" class="d-none">
                                                @csrf @method('PUT')
                                            </form>
                                            
                                            <button type="submit" form="form-update-{{ $item->id }}" class="btn btn-sm btn-info shadow-none" title="Actualizar">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </button>

                                            <form action="{{ route('admin.productos.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-none" onclick="return confirm('¿Dar de baja este producto?')" title="Eliminar">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.productos.restore', $item->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success fw-bold shadow-none text-uppercase px-2" style="font-size: 11px;">
                                                    <i class="bi bi-shield-check me-1"></i> Habilitar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                                    No hay productos cargados en el sistema actualmente.
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