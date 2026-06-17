<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark border-secondary">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('catalogo.index') }}">Mostrar todos los productos</a>
                        </li>
                        <li><hr class="dropdown-divider border-secondary"></li>
                        <li><h6 class="dropdown-header text-success fw-bold">CATEGORÍAS DISPONIBLES</h6></li>
                        
                        {{-- RECORREMOS LAS CATEGORÍAS REALES DESDE LA BASE DE DATOS --}}
                        @forelse($categoriasGlobales as $categoria)
                            <li>
                                <a class="dropdown-item text-uppercase py-2" style="font-size: 0.85rem;" href="{{ route('catalogo.index', $categoria->id) }}">
                                    {{ $categoria->nombre }}
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item-text text-muted small">No hay categorías cargadas</span></li>
                        @endforelse
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('consulta') }}">Consultas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('quienes_somos') }}">Sobre Evolvex</a>
                </li>
                        
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comercializacion') }}">Comercialización</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('terminos_condiciones') }}">Términos y condiciones</a>
                </li>
            </ul>

            <form action="{{ route('catalogo.index') }}" method="GET" class="d-flex" role="search">
                
                <input class="form-control me-2 bg-dark text-white border-secondary shadow-none" 
                    type="search" 
                    name="buscar" 
                    value="{{ request('buscar') }}" 
                    placeholder="¿Qué estás buscando?" 
                    aria-label="Buscar">
                    
                <button class="btn btn-outline-success" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0 justify-content-center">
                
                {{--  El carrito solo se muestra si el usuario NO está logueado, o si está logueado pero NO es administrador --}}
                @if(!auth()->check() || Auth::user()->rol_id !== 1)
                    <a href="{{ route('carrito.index') }}" class="btn btn-outline-light border-0 p-1 position-relative">
                        <i class="bi bi-cart3 fs-4"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $cantidadCarrito ?? 0 }}
                        </span>
                    </a>
                @endif

                <div class="dropdown">
                    @auth
                        <button class="btn btn-outline-success dropdown-toggle fw-bold text-white border-0 p-1 d-flex align-items-center gap-2 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle text-success fs-4"></i>
                            {{ Auth::user()->nombre_apellido }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('perfil.index') }}">Mi Perfil</a></li>
                            
                            {{-- Si es Administrador ve el Panel Admin, de lo contrario ve "Mis Compras" --}}
                            @if(Auth::user()->rol_id === 1)
                                <li><a class="dropdown-item text-warning" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('compras.historial') }}"><i class="bi bi-clock-history me-2"></i>Mis Compras</a></li>
                            @endif

                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger w-100 text-start" style="background: none; border: none;">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endauth

                    @guest
                        <button class="btn btn-outline-light border-0 p-1 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesión</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Crear Usuario</a></li> 
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>