@extends('layouts.app')

@section('main')
<main class="container py-5 my-5" style="background-color: #0d0f12; min-height: 80vh;">
    
    <div class="mb-5 text-center text-md-start">
        <h2 class="text-success fw-bold text-uppercase display-6">
            <i class="bi bi-cart3 me-2"></i> Mi Carrito de Compras
        </h2>
        <p class="text-white-50">Revisá tu lista de suplementos antes de proceder al pago.</p>
    </div>

    @if(session('exito'))
        <div class="alert alert-success bg-dark text-success border-success alert-dismissible fade show mb-4" role="alert">
            {{ session('exito') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger bg-dark text-danger border-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($items) && $items->count() > 0)
        <div class="row g-4">
            
            <div class="col-12 col-lg-8">
                <div class="table-responsive bg-dark p-3 rounded-4 border border-secondary shadow-lg">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-success border-secondary small text-uppercase">
                                <th scope="col">Producto</th>
                                <th scope="col" class="text-center">Precio</th>
                                <th scope="col" class="text-center">Cantidad</th>
                                <th scope="col" class="text-end">Subtotal</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach($items as $item)
                                <tr class="border-secondary">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold text-white text-uppercase">{{ $item->producto->nombre }}</span> 
                                        </div>
                                    </td>
                                    <td class="text-center text-white-50">
                                        ${{ number_format($item->precio_unitario, 2, ',', '.') }} 
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary px-3 py-2 fs-6 rounded-pill">
                                            {{ $item->cantidad }}
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold text-success">
                                        ${{ number_format($item->subtotal, 2, ',', '.') }} 
                                    </td>
                                    <td class="text-end">
                                        @auth
                                            @if(auth()->user()->rol_id == 2)
                                                {{-- Solo el Cliente puede remover productos individuales --}}
                                                <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" class="d-inline"> 
                                                    @csrf
                                                    @method('DELETE') 
                                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2 shadow-none" title="Eliminar producto">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form> 
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <a href="{{ url('/catalogo') }}" class="btn btn-outline-light rounded-pill px-4 py-2 small">
                        <i class="bi bi-arrow-left me-1"></i> Seguir Comprando
                    </a>

                    @auth
                        @if(auth()->user()->rol_id == 2)
                            {{-- Solo el cliente puede vaciar la colección del carrito --}}
                            <form action="{{ route('carrito.vaciar') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que querés vaciar todo tu carrito de compras?');">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4 py-2 small shadow-none">
                                    <i class="bi bi-cart-x me-1"></i> Vaciar Carrito
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card bg-dark text-white border-secondary p-4 rounded-4 shadow-lg">
                    <h4 class="fw-bold text-white mb-4 text-uppercase border-bottom border-secondary pb-2 small text-muted">Resumen de tu pedido</h4>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-white-50">Productos seleccionados:</span>
                        <span class="fw-bold">{{ $items->sum('cantidad') }} u.</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4 fs-5 border-top border-secondary pt-3">
                        <span class="fw-bold">Total a pagar:</span>
                        <span class="fw-bold text-success">
                            ${{ $carrito ? number_format($carrito->total, 2, ',', '.') : '0,00' }}
                        </span>
                    </div>

                    <div class="d-grid">
                        @auth
                            @if(auth()->user()->rol_id == 2)
                                {{-- CLIENTE: Procesa la compra de forma normal --}}
                                <form action="{{ route('carrito.confirmar') }}" method="POST"> 
                                    @csrf
                                    <button type="submit" class="btn btn-success fw-bold text-uppercase py-3 rounded-pill shadow-none w-100"> 
                                        <i class="bi bi-credit-card me-2"></i> Finalizar Compra
                                    </button>
                                </form> 
                            @else
                                {{-- ADMINISTRADOR: Se le bloquea la pasarela de pagos con un aviso --}}
                                <button class="btn btn-secondary fw-bold text-uppercase py-3 rounded-pill shadow-none w-100" disabled>
                                    <i class="bi bi-shield-lock me-2"></i> Bloqueado para Administrador
                                </button>
                                <small class="text-center text-muted mt-2">Los administradores de la tienda no pueden generar órdenes de compra.</small>
                            @endif
                        @endauth

                        @guest
                            {{-- Invitado anónimo: Se le pide loguearse --}}
                            <a href="{{ route('login') }}" class="btn btn-success fw-bold text-uppercase py-3 rounded-pill shadow-none w-100 text-center text-decoration-none">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Iniciar Sesión para Comprar
                            </a>
                        @endguest
                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-6 text-center bg-dark p-5 rounded-4 border border-secondary shadow-lg">
                <i class="bi bi-cart-x text-muted display-1 mb-4"></i>
                <h4 class="fw-bold text-white mb-3">Tu carrito está vacío</h4>
                <p class="text-white-50 mb-4">Parece que todavía no agregaste ningún suplemento a tu pedido.</p>
                <a href="{{ url('/catalogo') }}" class="btn btn-success fw-bold text-uppercase px-5 py-3 rounded-pill shadow-none">
                    Ver Catálogo de Productos
                </a>
            </div>
        </div>
    @endif

</main>
@endsection