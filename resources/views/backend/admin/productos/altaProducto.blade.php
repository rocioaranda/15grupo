@extends('layouts.app')

@section('main')
<div class="container py-4">
    <h4 class="fw-bold text-success mb-4">Agregar Producto</h4>

    @if(session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card bg-dark text-white border-secondary">
        <div class="card-body">
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nombre *</label>
                        <input type="text" name="nombre"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ old('nombre') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Categoría *</label>
                        <select name="categoria_id"
                                class="form-select bg-dark text-white border-secondary" required>
                            <option value="">Seleccioná una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>{{-- ← este cierre faltaba --}}

                    <div class="col-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="form-control bg-dark text-white border-secondary">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Precio *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark text-white border-secondary">$</span>
                            <input type="number" name="precio"
                                   class="form-control bg-dark text-white border-secondary"
                                   placeholder="0.00" min="0" step="0.01"
                                   value="{{ old('precio') }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stock *</label>
                        <input type="number" name="stock"
                               class="form-control bg-dark text-white border-secondary"
                               placeholder="0" min="0"
                               value="{{ old('stock', 0) }}" required>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox"
                                   name="activo" id="activo" value="1"
                                   {{ old('activo', '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Producto activo</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Imagen</label>
                        <input type="file" name="imagen" accept="image/*"
                               class="form-control bg-dark text-white border-secondary">
                        <div class="form-text text-secondary">PNG, JPG, WEBP — máx. 5 MB</div>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/admin" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">+ Agregar producto</button>
                </div>
                <div class="mb-3">
               <a href="/admin" class="btn btn-outline-light">
                   <i class="bi bi-arrow-left"></i> Volver al Panel
               </a>
                   </div>

            </form>
        </div>
    </div>
</div>
@endsection