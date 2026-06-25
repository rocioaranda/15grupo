@extends('layouts.app')

@section('main')
<main class="container py-5 my-5" style="background-color: #0d0f12; min-height: 80vh;">
    
    <div class="mb-5 text-center text-md-start">
        <h2 class="text-success fw-bold text-uppercase display-6">
            <i class="bi bi-bag-check me-2"></i> Mi Historial de Compras
        </h2>
        <p class="text-white-50">Consultá el detalle y los suplementos de tus pedidos anteriores.</p>
    </div>

    @if($compras->count() > 0)
        <div class="row g-4">
            <div class="col-12">
                @foreach($compras as $compra)
                    <div class="card bg-dark text-white border-secondary mb-4 rounded-4 shadow-lg">
                        <div class="card-header border-secondary bg-black p-3 d-flex flex-wrap justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small text-uppercase d-block">Pedido N°</span>
                                <span class="fw-bold text-success">#{{ $compra->id }}</span>
                            </div>
                            <div>
                                <span class="text-muted small text-uppercase d-block">Fecha de Compra</span>
                                <span class="fw-bold text-white">
                                    {{-- El cast datetime de tu modelo nos permite usar format() de forma directa --}}
                                    {{ $compra->fecha_venta ? $compra->fecha_venta->format('d/m/Y H:i') : 'Sin fecha' }}
                                </span>
                            </div>
                            <div class="text-md-end mt-2 mt-md-0">
                                <span class="text-muted small text-uppercase d-block">Total Abonado</span>
                                <span class="fw-bold text-success fs-5">${{ number_format($compra->total, 2, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dark table-hover align-middle mb-0 text-white-50">
                                    <thead>
                                        <tr class="text-success small border-secondary text-uppercase" style="font-size: 0.8rem;">
                                            <th class="ps-4">Suplemento</th>
                                            <th class="text-center">Precio Unitario</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-end pe-4">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($compra->detalles as $detalle)
                                            <tr class="border-secondary small">
                                                <td class="ps-4 fw-bold text-white text-uppercase">
                                                    {{ $detalle->producto->nombre }}
                                                </td>
                                                <td class="text-center">
                                                    ${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary rounded-pill px-3 py-1">
                                                        {{ $detalle->cantidad }} u.
                                                    </span>
                                                </td>
                                                <td class="text-end pe-4 fw-bold text-white">
                                                    ${{ number_format($detalle->subtotal, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-6 text-center bg-dark p-5 rounded-4 border border-secondary shadow-lg">
                <i class="bi bi-emoji-neutral text-muted display-1 mb-4"></i>
                <h4 class="fw-bold text-white mb-3">Aún no registrás compras</h4>
                <p class="text-white-50 mb-4">Tus pedidos confirmados aparecerán organizados en esta sección.</p>
                <a href="{{ url('/catalogo') }}" class="btn btn-success fw-bold text-uppercase px-5 py-3 rounded-pill shadow-none">
                    Ir al Catálogo de Productos
                </a>
            </div>
        </div>
    @endif

</main>
@endsection