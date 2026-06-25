@extends('layouts.app')

@section('main')
<main class="container py-5" style="background-color: #0d0f12; min-height: 85vh;">
    @if(session('exito'))
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0 mb-4 shadow mx-auto" role="alert" style="max-width: 600px;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('exito') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4 justify-content-center">
        <div class="col-12 col-md-10 col-lg-6 text-center text-md-start">
            <h1 class="fw-bold text-white mb-1 fs-2 fs-md-1">Hola, <span class="text-success">{{ $usuario->nombre_apellido }}</span></h1>
            <p class="text-muted small">Bienvenido a tu panel de control en Evolvex. Acá podés ver y gestionar tus datos personales de forma segura.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <div class="card bg-dark text-white border-secondary shadow-lg p-3 p-md-4">
                
                <ul class="nav nav-pills mb-4 justify-content-center p-1 rounded" id="perfilTabs" role="tablist" style="background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link active w-100 fw-bold text-uppercase" id="ver-tab" data-bs-toggle="tab" data-bs-target="#tab-ver" type="button" role="tab" aria-controls="tab-ver" aria-selected="true" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <i class="bi bi-eye me-1 me-md-2"></i>Mis Datos
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 fw-bold text-uppercase @if($errors->any()) text-danger @endif" id="editar-tab" data-bs-toggle="tab" data-bs-target="#tab-editar" type="button" role="tab" aria-controls="tab-editar" aria-selected="false" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <i class="bi bi-pencil-square me-1 : me-md-2"></i>Modificar Datos
                        </button>
                    </li>
                </ul>

                <div class="tab-content pt-1" id="perfilTabsContent">
                    
                    <div class="tab-pane fade show active" id="tab-ver" role="tabpanel" aria-labelledby="ver-tab">
                        <div class="text-center mb-4">
                            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 75px; height: 75px;">
                                <i class="bi bi-person-fill text-success fs-2"></i>
                            </div>
                            <h5 class="fw-bold mb-0 fs-5">{{ $usuario->nombre_apellido }}</h5>
                            
                            {{--  Comprobación directa usando auth() --}}
                            @if(auth()->user()->rol_id == 1)
                                <span class="badge bg-danger mt-2 text-uppercase border border-danger-subtle px-3 py-1 animate__animated animate__fadeIn" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="bi bi-shield-lock-fill me-1"></i>Administrador
                                </span>
                            @else
                                <span class="badge bg-success mt-2 text-uppercase border border-success-subtle px-3 py-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="bi bi-check-circle-fill me-1"></i>Cliente Activo
                                </span>
                            @endif
                        </div>

                        <hr class="border-secondary mb-4">

                        <div class="mb-3">
                            <label class="text-muted small text-uppercase d-block mb-1" style="font-size: 0.7rem; font-weight: 700;">Nombre Completo</label>
                            <span class="fw-semibold text-white fs-6 fs-md-5">{{ $usuario->nombre_apellido }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small text-uppercase d-block mb-1" style="font-size: 0.7rem; font-weight: 700;">Dirección de Correo Electrónico</label>
                            <span class="fw-semibold text-white fs-6 fs-md-5 text-break">{{ $usuario->email }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small text-uppercase d-block mb-1" style="font-size: 0.7rem; font-weight: 700;">Teléfono de Contacto</label>
                            <span class="fw-semibold text-white fs-6 fs-md-5">{{ $usuario->telefono ?? 'No registrado' }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small text-uppercase d-block mb-1" style="font-size: 0.7rem; font-weight: 700;">Fecha de Registro</label>
                            <span class="fw-semibold text-white fs-6 fs-md-5">{{ $usuario->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="tab-pane fade @if($errors->any()) show active @endif" id="tab-editar" role="tabpanel" aria-labelledby="editar-tab">
                        <form action="{{ route('perfil.actualizar') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase mb-1" style="font-size: 0.7rem; font-weight: 700;">Modificar Nombre y Apellido</label>
                                <input type="text" name="nombre_apellido" class="form-control bg-secondary text-white border-0 shadow-none py-2 @error('nombre_apellido') is-invalid @enderror" value="{{ old('nombre_apellido', $usuario->nombre_apellido) }}" placeholder="Ej: Juan Pérez">
                                @error('nombre_apellido')
                                    <div class="invalid-feedback fw-bold small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase mb-1" style="font-size: 0.7rem; font-weight: 700;">Modificar Correo Electrónico (Email)</label>
                                <input type="email" name="email" class="form-control bg-secondary text-white border-0 shadow-none py-2 @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}" placeholder="ejemplo@correo.com">
                                @error('email')
                                    <div class="invalid-feedback fw-bold small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase mb-1" style="font-size: 0.7rem; font-weight: 700;">Modificar Teléfono de Contacto</label>
                                <input type="text" name="telefono" class="form-control bg-secondary text-white border-0 shadow-none py-2 @error('telefono') is-invalid @enderror" value="{{ old('telefono', $usuario->telefono) }}" placeholder="Código de área + número">
                                @error('telefono')
                                    <div class="invalid-feedback fw-bold small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="border-secondary my-4">
                            
                            <div class="p-2.5 rounded mb-3" style="background-color: rgba(13, 202, 240, 0.08); border-left: 4px solid #0dcaf0;">
                                <p class="text-info small mb-0 fw-bold" style="font-size: 0.75rem;">
                                    <i class="bi bi-info-circle-fill me-1.5"></i>Seguridad de la Cuenta:
                                </p>
                                <p class="text-white-50 small mb-0 mt-0.5 ms-3" style="font-size: 0.72rem;">
                                    Dejá los campos de contraseña en blanco si querés conservar tu contraseña actual.
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase mb-1" style="font-size: 0.7rem; font-weight: 700;">Nueva Contraseña (Opcional)</label>
                                <input type="password" name="password" class="form-control bg-secondary text-white border-0 shadow-none py-2 @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres">
                                @error('password')
                                    <div class="invalid-feedback fw-bold small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small text-uppercase mb-1" style="font-size: 0.7rem; font-weight: 700;">Confirmar Nueva Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control bg-secondary text-white border-0 shadow-none py-2" placeholder="Repetí la nueva contraseña">
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <button type="button" class="btn btn-outline-secondary flex-fill fw-bold py-2 order-2 order-sm-1" onclick="document.getElementById('ver-tab').click()" style="font-size: 0.85rem;">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-success flex-fill fw-bold py-2 order-1 order-sm-2 shadow-none" style="font-size: 0.85rem;">
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        
    </div>
</main>
@endsection