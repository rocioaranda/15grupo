@extends('layouts.app')

@section('main')
<main class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center text-md-start">
            <h1 class="fw-bold text-white mb-1">Hola, <span class="text-success">{{ Auth::user()->nombre_apellido }}</span></h1>
            <p class="text-muted">Bienvenido a tu panel de control en Evolvex. Acá podés ver tus datos y gestionar tus compras.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card bg-dark text-white border-0 shadow-lg p-4 h-100">
                <div class="text-center mb-4">
                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-fill text-success fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-0">{{ Auth::user()->nombre_apellido }}</h5>
                </div>

                <hr class="border-secondary mb-4">

                <div class="mb-3">
                    <label class="text-muted small text-uppercase d-block mb-1">Correo Electrónico</label>
                    <span class="fw-semibold text-white">{{ Auth::user()->email }}</span>
                </div>

                <div class="mb-3">
                    <label class="text-muted small text-uppercase d-block mb-1">Teléfono de Contacto</label>
                    <span class="fw-semibold text-white">{{ Auth::user()->telefono ?? 'No registrado' }}</span>
                </div>

                <div class="mb-4">
                    <label class="text-muted small text-uppercase d-block mb-1">Miembro desde</label>
                    <span class="fw-semibold text-white">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                </div>

                <button class="btn btn-outline-success btn-sm w-100 fw-bold shadow-none mt-auto">
                    Editar mis Datos
                </button>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card bg-dark text-white border-0 shadow-lg p-4 h-100">
                <h4 class="fw-bold text-success mb-4">Mis Pedidos Recientes</h4>

                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-cart-x text-muted" style="font-size: 3.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-white mb-2">¡Todavía no realizaste ninguna compra!</h5>
                    <p class="text-muted mb-4 small">Explorá nuestro catálogo y descubrí los mejores suplementos y accesorios deportivos.</p>
                    <a href="{{ route('catalogo') }}" class="btn btn-success fw-bold px-4 shadow-none">
                        Ir al Catálogo <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                </div>
        </div>
    </div>
</main>
@endsection