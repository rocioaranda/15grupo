@extends('layouts.app')

@section('main')
<div class="container py-4">

    <h4 class="fw-bold text-warning mb-4">Editar Producto</h4>

    {{-- ================= ALERTAS ================= --}}
    @if(session('exito'))
        <div class="alert alert-success">
            {{ session('exito') }}
        </div>
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

            <form action="{{ route('admin.productos.update', $producto->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- ================= NOMBRE ================= --}}
                    <div class="col-md-6">
                        <label class="form-label">Nombre *</label>
                        <input type="text"
                               name="nombre"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ old('nombre', $producto->nombre) }}"
                               required>
                    </div>

                    {{-- ================= CATEGORÍA ================= --}}
                    <div class="col-md-6">
                        <label class="form-label">Categoría *</label>
                        <select name="categoria_id"
                                class="form-select bg-dark text-white border-secondary"
                                required>
                            <option value="">Seleccionar categoría</option>

                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ================= DESCRIPCIÓN ================= --}}
                    <div class="col-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion"
                                  rows="3"
                                  class="form-control bg-dark text-white border-secondary">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    </div>

                    {{-- ================= PRECIO ================= --}}
                    <div class="col-md-4">
                        <label class="form-label">Precio *</label>
                        <input type="number"
                               name="precio"
                               step="0.01"
                               min="0"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ old('precio', $producto->precio) }}"
                               required>
                    </div>

                    {{-- ================= STOCK ================= --}}
                    <div class="col-md-4">
                        <label class="form-label">Stock *</label>
                        <input type="number"
                               name="stock"
                               min="0"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ old('stock', $producto->stock) }}"
                               required>
                    </div>

                    {{-- ================= ACTIVO ================= --}}
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="activo"
                                   value="1"
                                   {{ old('activo', $producto->activo) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Producto activo
                            </label>
                        </div>
                    </div>

                    {{-- ================= IMAGEN ACTUAL ================= --}}
                    <div class="col-12 text-center">
                        <label class="form-label text-secondary">Imagen actual</label><br>

                        @if($producto->url_imagen)
                            <img src="{{ asset('storage/' . $producto->url_imagen) }}"
                                 width="120"
                                 class="rounded border border-secondary">
                        @else
                            <p class="text-secondary">Sin imagen</p>
                        @endif
                    </div>

                    {{-- ================= NUEVA IMAGEN ================= --}}
                    <div class="col-12">
                        <label class="form-label">Cambiar imagen</label>
                        <input type="file"
                               name="imagen"
                               accept="image/*"
                               class="form-control bg-dark text-white border-secondary">
                        <div class="form-text text-secondary">
                            PNG, JPG o WEBP (opcional)
                        </div>
                    </div>

                </div>

                {{-- ================= BOTONES ================= --}}
                <div class="d-flex justify-content-end gap-2 mt-4">

                            <a href="{{ route('admin.productos.buscarEditar') }}"
            class="btn btn-outline-secondary">
                Cancelar
</a>

                    <button type="submit" class="btn btn-warning">
                        Actualizar producto
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection