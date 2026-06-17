@extends('layouts.app')

@section('main')
<div class="container-fluid py-5 text-white" style="background-color: #0d0f12; min-height: 90vh;">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3">
            <div>
                <h2 class="text-success fw-bold text-uppercase m-0"><i class="bi bi-receipt me-2"></i> Auditoría de Ventas</h2>
                <p class="text-muted m-0 mt-1">Monitoreo y filtrado de transacciones comerciales confirmadas.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light fw-bold shadow-none">
                <i class="bi bi-arrow-left me-1"></i> Volver al Panel
            </a>
        </div>

        <div class="card bg-dark border-secondary p-4 mb-4 rounded-4 shadow">
            <h5 class="text-success fw-bold text-uppercase mb-3 small"><i class="bi bi-funnel me-1"></i> Filtros de Búsqueda</h5>
            <form action="{{ route('admin.ventas.index') }}" method="GET" class="row g-3">
                
                <div class="col-12 col-sm-6 col-md-2">
                    <label class="form-label text-muted small text-uppercase fw-bold">N° de Orden</label>
                    <input type="number" name="orden_id" value="{{ request('orden_id') }}" class="form-control bg-secondary text-white border-0 shadow-none" placeholder="Ej: 1045">
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <label class="form-label text-muted small text-uppercase fw-bold">Cliente (Nombre o Email)</label>
                    <input type="text" name="cliente" value="{{ request('cliente') }}" class="form-control bg-secondary text-white border-0 shadow-none" placeholder="Buscar por cliente...">
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <label class="form-label text-muted small text-uppercase fw-bold">Desde Fecha</label>
                    <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-control bg-secondary text-white border-0 shadow-none">
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <label class="form-label text-muted small text-uppercase fw-bold">Hasta Fecha</label>
                    <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-control bg-secondary text-white border-0 shadow-none">
                </div>

                <div class="col-12 col-sm-6 col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-success fw-bold w-100 shadow-none">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                    <a href="{{ route('admin.ventas.index') }}" class="btn btn-outline-secondary w-100 shadow-none" title="Limpiar Filtros">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>

            </form>
        </div>

        @if($ventas->count() > 0)
            <div class="table-responsive bg-dark p-3 rounded-4 border border-secondary shadow-lg">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-success border-secondary small text-uppercase">
                            <th>N° Orden</th>
                            <th>Fecha y Hora</th>
                            <th>Cliente</th>
                            <th>Artículos Detallados</th>
                            <th class="text-center">Total Facturado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                            <tr class="border-secondary">
                                <td class="fw-bold text-info">#{{ $venta->id }}</td>
                                
                                <td class="text-white-50">
                                    {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}
                                </td>
                                
                                <td>
                                    <div class="fw-bold text-uppercase">{{ $venta->usuario->nombre_apellido ?? 'Usuario Eliminado' }}</div>
                                    <small class="text-muted">{{ $venta->usuario->email ?? '-' }}</small>
                                </td>
                                
                                <td>
                                    <ul class="list-unstyled mb-0 small text-white-50">
                                        @foreach($venta->detalles as $detalle)
                                            <li>
                                                <i class="bi bi-check-sm text-success"></i> 
                                                <span class="text-white fw-bold">{{ $detalle->cantidad }}x</span> 
                                                <span class="text-uppercase">{{ $detalle->producto->nombre ?? 'Producto Eliminado' }}</span>
                                                <span class="text-muted">(${{ number_format($detalle->precio_unitario ?? 0, 2, ',', '.') }} c/u)</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                
                                <td class="text-center fw-bold text-success fs-5">
                                    ${{ number_format($venta->total, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center bg-dark p-5 rounded-4 border border-secondary shadow-lg my-4">
                <i class="bi bi-receipt-cutoff text-muted display-1 mb-3 d-block"></i>
                <h4 class="fw-bold text-white">Sin registros de ventas</h4>
                <p class="text-muted mb-0">No se encontraron órdenes confirmadas que coincidan con los filtros aplicados.</p>
            </div>
        @endif

    </div>
</div>
@endsection