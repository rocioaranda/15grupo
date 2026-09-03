@extends('layouts.app')

@section('main')
<div class="container py-5">
    <div class="row g-5 align-items-center">

        {{-- Columna imagen --}}
        <div class="col-md-5">
            <div class="bg-black rounded-3 p-4 d-flex align-items-center justify-content-center" style="min-height: 350px;">
                <img src="{{ $producto->url_imagen ? asset('storage/' . $producto->url_imagen) : 'https://via.placeholder.com/300?text=Evolvex' }}"
                     class="img-fluid" style="max-height: 320px; object-fit: contain;"
                     alt="{{ $producto->nombre }}">
            </div>
        </div>

        {{-- Columna información --}}
        <div class="col-md-7 text-white">
            <span class="badge bg-success text-uppercase mb-2">
                {{ $producto->categoria->nombre ?? 'Suplemento' }}
            </span>

            <h1 class="fw-bold text-uppercase mb-3">{{ $producto->nombre }}</h1>

            <p class="text-white-50 mb-4">{{ $producto->descripcion }}</p>

            <h2 class="fw-bold text-success mb-4">
                ${{ number_format($producto->precio, 2, ',', '.') }}
            </h2>

            @if($producto->stock > 0)
                @auth
                    @if(auth()->user()->rol_id == 2)
                        <form action="{{ route('carrito.agregar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" class="btn btn-success rounded-pill px-5 py-2 fw-bold text-uppercase">
                                <i class="bi bi-cart-plus me-1"></i> Agregar al carrito
                            </button>
                        </form>
                    @else
                        <button class="btn btn-outline-secondary disabled rounded-pill px-5 py-2 fw-bold text-uppercase">
                            <i class="bi bi-shield-lock me-1"></i> Vista Admin
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success rounded-pill px-5 py-2 fw-bold text-uppercase text-decoration-none">
                        <i class="bi bi-box-arrow-in-right me-1"></i> comprar
                    </a>
                @endauth
            @else
                <button class="btn btn-outline-danger disabled rounded-pill px-5 py-2 fw-bold text-uppercase">
                    <i class="bi bi-dash-circle me-1"></i> Sin stock
                </button>
            @endif
        </div>

    </div>
</div>
@endsection