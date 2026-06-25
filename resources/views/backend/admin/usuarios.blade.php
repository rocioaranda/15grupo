@extends('layouts.app')

@section('main')
<div class="container-fluid py-5 text-white" style="background-color: #0d0f12; min-height: 90vh;">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
            <div>
                <h1 class="fw-bold text-info m-0">Padrón de Usuarios</h1>
                <p class="text-muted m-0 mt-1">Control y visualización de cuentas registradas en el sistema</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm shadow-none">
                <i class="bi bi-arrow-left me-1"></i> Volver al Panel
            </a>
        </div>

        @if(session('exito'))
            <div class="alert alert-success bg-dark text-success border-success mb-4 shadow-sm">
                {{ session('exito') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger bg-dark text-danger border-danger mb-4 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="alert alert-dark border-secondary d-flex flex-column flex-sm-row align-items-center justify-content-between p-3 mb-4 shadow-sm" style="background-color: #161b22;">
            <div class="d-flex align-items-center mb-3 mb-sm-0">
                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 45px; height: 45px;">
                    <i class="bi bi-person-gear text-info fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-white mb-0">¿Querés modificar tus propios datos de Administrador?</h6>
                    <p class="text-muted small mb-0">Tu cuenta actual ({{ auth()->user()->email }}) se gestiona de forma segura desde tu perfil privado.</p>
                </div>
            </div>
            <a href="{{ route('perfil.index') }}" class="btn btn-info btn-sm fw-bold text-dark px-3 shadow-none">
                <i class="bi bi-sliders me-1"></i> Gestionar Mi Cuenta
            </a>
        </div>

        <div class="card bg-dark text-white border-0 shadow-lg p-4">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle m-0">
                    <thead>
                        <tr class="text-muted border-secondary small text-uppercase">
                            <th>ID</th>
                            <th>Nombre y Apellido</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $user)
                            <tr class="border-secondary">
                                <td class="fw-bold text-muted">{{ $user->id }}</td>
                                <td class="fw-bold">{{ $user->nombre_apellido }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-white-50">{{ $user->telefono ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $user->rol_id == 1 ? 'bg-danger' : 'bg-primary' }}">
                                        {{ $user->rol_id == 1 ? 'Admin' : 'Cliente' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    @if(auth()->id() === $user->id)
                                        <span class="text-muted small italic p-1 bg-secondary rounded">Tu Cuenta</span>
                                    @else
                                        <form action="{{ route('admin.usuarios.eliminar', $user->id) }}" method="POST" class="d-inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow-none" 
                                                    onclick="return confirm('¿Seguro que deseas eliminar a {{ $user->nombre_apellido }}? Esta acción no se puede deshacer.')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection