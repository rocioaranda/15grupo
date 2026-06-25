<div class="col">
    <div class="card h-100 bg-dark text-white border-secondary rounded-3 shadow-sm transition-hover">
        
        <div class="position-relative text-center p-3 bg-black rounded-top-3 d-flex align-items-center justify-content-center" style="height: 200px;">
            <img src="{{ $producto->url_imagen ? asset('storage/' . $producto->url_imagen) : 'https://via.placeholder.com/200?text=Evolvex' }}"
                 class="img-fluid max-h-100" 
                 style="max-height: 180px; object-fit: contain;" 
                 alt="{{ $producto->nombre }}">
            
            <span class="position-absolute top-0 start-0 badge bg-success m-3 small text-uppercase">
                {{ $producto->categoria->nombre }}
            </span>
        </div>
        
        <div class="card-body d-flex flex-column justify-content-between">
            <div>
                <h5 class="card-title fw-bold text-white mb-2 fs-6 text-uppercase">{{ $producto->nombre }}</h5>
                <p class="card-text text-white-50 small mb-3" style="font-size: 0.85rem;">
                    {{ Str::limit($producto->descripcion, 75, '...') }}
                </p>
            </div>
            
            <div>
                <h3 class="fw-bold text-success mb-3">${{ number_format($producto->precio, 2, ',', '.') }}</h3>
            </div>
        </div>

        <div class="card-footer border-top-0 bg-transparent pb-3">
            @if($producto->stock > 0)
                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                    @csrf <button type="submit" class="btn btn-outline-success w-100 fw-bold rounded-pill text-uppercase py-2" style="font-size: 0.85rem;">
                        <i class="bi bi-cart-plus me-1"></i> Agregar
                    </button>
                </form>
            @else
                <button class="btn btn-outline-danger w-100 disabled rounded-pill text-uppercase py-2" style="font-size: 0.85rem;">
                    Agotado
                </button>
            @endif
        </div>
    </div>
</div>