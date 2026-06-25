@extends('layouts.app')

@section('main')
<div class="container-fluid py-5 text-white" style="background-color: #56e469; min-height: 90vh;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
            <div>
                <h1 class="fw-bold text-success m-0">Panel de Control</h1>
                <p class="text-muted m-0 mt-1">Bienvenido, {{ Auth::user()->nombre_apellido }} | Administrador</p>
            </div>
            <span class="badge bg-success p-2 fs-6 shadow-none">Modo Admin</span>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #198754 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Productos</h6>
                            <h2 class="fw-bold my-2 text-success">24</h2>
                            <a href="/catalogo" class="text-decoration-none small text-white-50 hover-success">Gestionar catálogo →</a>
                        </div>
                        <i class="bi bi-box-seam text-success fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #0dcaf0 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Usuarios Registrados</h6>
                            <h2 class="fw-bold my-2 text-info">12</h2>
                            <span class="text-white-50 small">Clientes activos</span>
                        </div>
                        <i class="bi bi-people text-info fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #ffc107 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Pedidos Nuevos</h6>
                            <h2 class="fw-bold my-2 text-warning">5</h2>
                            <span class="text-white-50 small">Por revisar</span>
                        </div>
                        <i class="bi bi-cart-check text-warning fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

       <div class="card bg-dark text-white border-0 shadow-lg p-4">
    <h4 class="fw-bold mb-4 text-success border-bottom border-secondary pb-2">Panel de Administración</h4>

    {{-- Gestión de Productos --}}
    <div class="mb-4">
        <h6 class="text-secondary mb-3"><i class="bi bi-box-seam me-2"></i>Productos</h6>
        <div class="d-flex flex-column gap-2">
            <a href="{{ route('admin.productos.create') }}" class="btn btn-success w-100 text-start">
         <i class="..."></i> Agregar Producto</a>
             <a href="{{ route('admin.productos.edit', 1) }}" 
           class="btn btn-outline-success fw-bold shadow-none text-start">
            <i class="bi bi-pencil-square me-2"></i> Editar Productos
        </a>       
        <a href="{{ route('admin.productos.eliminar') }}" 
        class="btn btn-outline-danger fw-bold shadow-none text-start">
            <i class="bi bi-trash me-2"></i> Eliminar Productos
        </a>
        </div>
    </div>


  {{-- Gestión de Consultas --}}
<div class="mb-4">
    <h6 class="text-secondary mb-3"><i class="bi bi-chat-dots me-2"></i>Consultas</h6>
    <div class="d-flex flex-column gap-2">
        <a href="{{ route('admin.consultas') }}?estado=pendiente" class="btn btn-outline-warning fw-bold shadow-none text-start">
            <i class="bi bi-hourglass-split me-2"></i> Ver Consultas Pendientes
        </a>
        <a href="{{ route('admin.consultas') }}?estado=vista" class="btn btn-outline-info fw-bold shadow-none text-start">
            <i class="bi bi-eye me-2"></i> Ver Consultas Vistas
        </a>
        <a href="{{ route('admin.consultas') }}?estado=respondida" class="btn btn-outline-success fw-bold shadow-none text-start">
            <i class="bi bi-check-circle me-2"></i> Ver Consultas Respondidas
        </a>
        <a href="{{ route('admin.consultas') }}" class="btn btn-outline-light border-secondary fw-bold shadow-none text-start">
            <i class="bi bi-list-ul me-2"></i> Ver Todas las Consultas
        </a>
    </div>
</div>
@endsection