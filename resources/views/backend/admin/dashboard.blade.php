@extends('layouts.app')

@section('main')
<div class="container-fluid py-5 text-white" style="background-color: #eff4ef; min-height: 90vh;">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
            <div>
                <h1 class="fw-bold text-success m-0">Panel de Control</h1>
                <p class="text-muted m-0 mt-1">Bienvenido, {{ Auth::user()->nombre_apellido ?? 'Administrador' }} | Modo Gestión</p>
            </div>
            <span class="badge bg-success p-2 fs-6 shadow-none">Modo Admin</span>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-12 col-md-3">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #198754 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Productos</h6>
                            <h2 class="fw-bold my-2 text-success">{{ $cantidadProductos }}</h2>
                            <a href="{{ route('admin.productos.index') }}" class="text-decoration-none small text-white-50 hover-success">Gestionar catálogo →</a>
                        </div>
                        <i class="bi bi-box-seam text-success fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #0dcaf0 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Usuarios</h6>
                            <h2 class="fw-bold my-2 text-info">{{ $cantidadUsuarios }}</h2>
                            <a href="{{ route('admin.usuarios.index') }}" class="text-decoration-none small text-white-50">Cuentas registradas →</a>
                        </div>
                        <i class="bi bi-people text-info fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #ffc107 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Pedidos Confirmados</h6>
                            <h2 class="fw-bold my-2 text-warning">{{ $cantidadPedidos }}</h2>
                            <a href="{{ route('admin.ventas.index') }}" class="text-decoration-none small text-white-50">Auditar órdenes →</a>
                        </div>
                        <i class="bi bi-cart-check text-warning fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-dark text-white border-0 shadow-lg p-3 position-relative" style="border-left: 4px solid #20c997 !important;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted text-uppercase fw-bold small">Ingresos Totales</h6>
                            <h2 class="fw-bold my-2 text-transparent" style="color: #20c997;">${{ number_format($totalVentas, 2, ',', '.') }}</h2>
                            <span class="text-white-50 small">Caja comercial bruta</span>
                        </div>
                        <i class="bi bi-cash-coin text-transparent fs-1 opacity-50" style="color: #20c997;"></i>
                    </div>
                </div>
            </div>
        </div>

        @if($productoEstrella && $productoEstrella->producto)
            <div class="card bg-dark text-white border-0 border-start border-success p-4 mb-5 shadow-lg">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-trophy-fill text-warning fs-2"></i>
                    <div>
                        <h5 class="fw-bold text-success text-uppercase m-0">Producto Estrella / Más Vendido</h5>
                        <p class="m-0 text-white-50 mt-1">
                            <span class="text-white fw-bold text-uppercase">{{ $productoEstrella->producto->nombre }}</span> 
                            con un acumulado histórico de <span class="text-success fw-bold">{{ $productoEstrella->total_vendido }} unidades</span> entregadas.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="card bg-dark text-white border-0 shadow-lg p-4">
            <h4 class="fw-bold mb-4 text-success border-bottom border-secondary pb-2">Operaciones del Panel</h4>

            <div class="row">
                <div class="col-12 col-md-6">
                    {{-- Gestión de Productos --}}
                   <div class="mb-4">
    <h6 class="text-secondary mb-3">
        <i class="bi bi-box-seam me-2"></i> Gestión de Productos
    </h6>

    <div class="d-flex flex-column gap-2">

        <!-- Alta de producto -->
        <a href="{{ route('admin.productos.create') }}"
           class="btn btn-success w-100 text-start">
            <i class="bi bi-plus-circle me-2"></i>
            Agregar Producto
        </a>

       <a href="{{ route('admin.productos.buscarEditar') }}"
    class="btn btn-outline-warning w-100 text-start">
        <i class="bi bi-pencil-square me-2"></i>
        Editar Productos
    </a>
    <a href="{{ route('admin.productos.eliminar') }}"
   class="btn btn-outline-danger w-100 text-start">
    <i class="bi bi-trash me-2"></i>
    Eliminar Productos
</a>

    </div>
        </div>

                    {{-- Gestión de Ventas / Reportes --}}
                    <div class="mb-4">
                        <h6 class="text-secondary mb-3"><i class="bi bi-bar-chart me-2"></i>Auditoría Comercial e Ingresos</h6>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.ventas.index') }}" class="btn btn-outline-info fw-bold shadow-none text-start">
                                <i class="bi bi-receipt me-2"></i> Ver Registro de Ventas Completo 
                            </a>
                        </div>
                    </div>

                    {{-- Gestión de Usuarios --}}
                    <div class="mb-4">
                        <h6 class="text-secondary mb-3"><i class="bi bi-people me-2"></i>Control de Usuarios registrados</h6>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-light border-secondary fw-bold shadow-none text-start">
                                <i class="bi bi-person-lines-fill me-2"></i> Visualizar Padón de Usuarios y Clientes
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    {{-- Gestión de Consultas --}}
                    <div class="mb-4">
                        <h6 class="text-secondary mb-3"><i class="bi bi-chat-dots me-2"></i>Bandeja de Entrada e Interacciones</h6>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.consultas') }}" class="btn btn-outline-warning fw-bold shadow-none text-start">
                                <i class="bi bi-envelope-open me-2"></i> Ver todas las Consultas y Mensajes Guardados
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection