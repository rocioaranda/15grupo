<div class="table-responsive">
    <table class="table table-dark table-hover border-secondary mb-0">
        <thead>
            <tr class="text-secondary border-bottom border-secondary">
                <th>Producto</th>
                <th class="text-center">Cant.</th>
                <th class="text-end">Precio</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($venta) && $venta->detalles && $venta->detalles->count() > 0)
                @foreach($venta->detalles as $item)
                    <tr class="align-middle border-bottom border-secondary">
                        <td>{{ $item->producto ? $item->producto->nombre : 'Producto no disponible' }}</td>
                        <td class="text-center">{{ $item->cantidad ?? 0 }}</td>
                        <td class="text-end">${{ number_format($item->precio_unitario ?? 0, 2, ',', '.') }}</td>
                        <td class="text-end">${{ number_format($item->subtotal ?? 0, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">No se pudieron cargar los detalles del comprobante.</td>
                </tr>
            @endif
        </tbody>
        
        @if(isset($venta) && $venta->detalles && $venta->detalles->count() > 0)
            <tfoot>
                <tr class="fw-bold align-middle border-top border-secondary">
                    <td colspan="3" class="text-end text-secondary py-3">Total de la compra:</td>
                    <td class="text-end text-success fs-5 py-3">${{ number_format($venta->total ?? 0, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>

{{--  Contenedor con los botones de acción para el PDF y Correo --}}
<div class="d-flex justify-content-center gap-3 mt-4">

    {{-- Botón de descarga directa (Método GET) --}}
    <a href="{{ route('compra.descargar') }}" class="btn btn-success btn-lg px-4 fw-bold shadow-sm">
        <i class="bi bi-file-earmark-pdf-fill me-2"></i>Descargar comprobante
    </a>

</div>