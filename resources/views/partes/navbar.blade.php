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
                        <a class="nav-link" href="/quienes_somos">Sobre Envolex</a>
                    </li>
                   <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Productos
                  </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <li><a class="dropdown-item" href="#">Mostrar todos los productos</a></li>
            
                    <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">Según tu objetivo</a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Aumento de masa muscular</a></li>
                    <li><a class="dropdown-item" href="#">Definición / Quemar grasa</a></li>
                    <li><a class="dropdown-item" href="#">Salud y vitalidad</a></li>
                    </ul>
                        </li>
                    </ul>
            

                     <li class="nav-item">
                      <a class="nav-link" href="{{ url('/contacto') }}">Contacto</a>
                     </li>
                
                     <li class="nav-item">
                      <a class="nav-link" href="/comercializacion">Comercialización</a>
                    </li>
                </ul>
               
                   
                <form class="d-flex mx-auto my-2 my-lg-0" role="search" style="width: 40%; min-width: 250px;">
                    <input class="form-control me-2 bg-dark text-white border-secondary" type="search" placeholder="¿Qué estás buscando?">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

              <div class="d-flex align-items-center gap-3">
              @include('carrito') 
             <div class="dropdown">
              <button class="btn btn-outline-light border-0 p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle fs-4"></i>
              </button>
               <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/login" style="pointer-events: none; cursor: default;">Iniciar Sesión</a></li>
            <li><a class="dropdown-item" href="/register" style="pointer-events: none; cursor: default;">Crear Usuario</a></li> 
        </ul>
        </div>
    </div>
</nav>