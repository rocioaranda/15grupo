@extends('layouts.app')

@section('main')
<div class="container py-5" style="max-width: 650px;">
    <div class="card bg-dark border-secondary shadow-lg p-4 p-md-5 text-center">
        
        <div class="mb-3">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 4.5rem;"></i>
        </div>
        
        <h2 class="fw-bold text-white mb-3">¡Pedido confirmado!</h2>

        @if(session('tipo_entrega') === 'retiro')
            <div class="alert bg-black border border-secondary text-white mt-3 text-start small p-3 rounded-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-envelope-check text-success fs-4 me-3"></i>
                    <div>
                        Te contactaremos al correo registrado para avisarte cuándo tu pedido 
                        está listo para retirar en nuestra sucursal.
                    </div>
                </div>
            </div>
        @else
            <p class="text-white-50 mt-2 mb-4">
                Tu pedido fue procesado exitosamente. Recibirás novedades sobre el estado de tu envío en tu correo registrado.
            </p>
        @endif

        {{-- Botón de comprobante y acciones --}}
        <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
            <a href="{{ route('compra.descargar') }}" class="btn btn-success btn-lg fw-bold px-4 shadow-sm">
                <i class="bi bi-file-earmark-pdf me-2"></i>Descargar comprobante PDF
            </a>
        </div>

        <div class="mt-4 pt-3 border-top border-secondary">
            <a href="{{ route('catalogo.index') }}" class="text-decoration-none text-white-50 hover-text-white small">
                <i class="bi bi-arrow-left me-1"></i> Seguir comprando
            </a>
        </div>

    </div>
</div>
@endsection