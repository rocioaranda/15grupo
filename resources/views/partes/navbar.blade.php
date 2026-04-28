<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/quienes_somos">Sobre Evolvex</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/terminos_condiciones">Términos y condiciones</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark border-secondary">
                        <li><a class="dropdown-item" href="{{ url('/catalogo') }}">Mostrar todos los productos</a></li>
                        <li><hr class="dropdown-divider border-secondary"></li>
                        <li><h6 class="dropdown-header text-success fw-bold">SEGÚN TU OBJETIVO</h6></li>
                        <li><a class="dropdown-item" href="{{ url('/Masa_aumento') }}">Aumento de masa muscular</a></li>
                        <li><a class="dropdown-item" href="{{ url('/quemar_grasa') }}">Definición / Quemar grasa</a></li>
                        <li><a class="dropdown-item" href="{{ url('/vitalidad_salud') }}">Salud y vitalidad</a></li>
                        <li><hr class="dropdown-divider border-secondary"></li>
                        <li><a class="dropdown-item" href="{{ url('/acce') }}">Accesorios</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/comercializacion">Comercialización</a>
                </li>
            </ul>

           //botón del buscador 
            <form class="d-flex mx-lg-3 my-2 my-lg-0 flex-grow-1 buscador-desactivado" role="search" style="max-width: 400px;">
            <input class="form-control me-2 bg-dark text-white border-secondary shadow-none" type="search" placeholder="¿Qué estás buscando?" readonly> 
            <button class="btn btn-outline-success" type="button">
            <i class="bi bi-search"></i>
            </button>
            </form>
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0 justify-content-center">
                @include('carrito') 
                <div class="dropdown">
                    <button class="btn btn-outline-light border-0 p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                         <li><a class="dropdown-item" href="/login">Iniciar Sesión</a></li>
                          <li><a class="dropdown-item" href="/register">Crear Usuario</a></li> 
                     </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>