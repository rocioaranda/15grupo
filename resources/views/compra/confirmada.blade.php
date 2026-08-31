@extends('layouts.app')

@section('main')
<div class="container py-5 text-center" style="max-width: 600px;">

    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
    <h2 class="mt-3 fw-bold text-white">¡Pedido confirmado!</h2>

    @if(session('tipo_entrega') === 'retiro')
        <div class="alert alert-secondary border-secondary text-white mt-4 text-start">
            <i class="bi bi-envelope-check me-2 text-success fs-5"></i>
            Te contactaremos al correo registrado para avisarte cuándo tu pedido
            está listo para retirar en nuestra sucursal.
        </div>
    @else
        <p class="text-white-50 mt-3">
            Tu pedido fue procesado. Recibirás novedades sobre el envío en tu correo registrado.
        </p>
    @endif

    @if(session('exito'))
        <div class="alert alert-success mt-3">{{ session('exito') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    {{-- Boton de comprobante --}}
    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">

        <a href="{{ route('compra.descargar') }}" class="btn btn-success btn-lg fw-bold">
            <i class="bi bi-file-earmark-pdf me-2"></i>Descargar comprobante PDF
        </a>
    </div>

    <a href="{{ route('catalogo.index') }}" class="btn btn-link text-secondary mt-4 d-block">
        Seguir comprando
    </a>

</div>
@endsection