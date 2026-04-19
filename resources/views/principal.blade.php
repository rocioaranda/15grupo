<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Principal</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v=1.1">
</head>

<body>

    <header class="header-banner">
        <img src="{{ asset('img/logo1.jpeg') }}" alt="Banner Principal" class="img-banner">
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/quienes_somos">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Según tu objetivo
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Aumento de masa muscular</a></li>
                            <li><a class="dropdown-item" href="#">Definición / Quemar grasa</a></li>
                            <li><a class="dropdown-item" href="#">Salud y vitalidad</a></li>
                        </ul>
                    </li>

                     <li class="nav-item">
                <a class="nav-link" href="{{ url('/contacto') }}">Contacto</a>
                </li>
                
                </ul>
               
                   
                <form class="d-flex mx-auto my-2 my-lg-0" role="search" style="width: 40%; min-width: 250px;">
                    <input class="form-control me-2" type="search" placeholder="¿Qué estás buscando?">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

               <div class="d-flex align-items-center gap-3">
               <a href="/carrito" class="btn btn-outline-light border-0 p-1 position-relative">
                    <i class="bi bi-cart3 fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        0
                    </span>
                </a>

                    <div class="dropdown">
                    <button class="btn btn-outline-light border-0 p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/login">Iniciar Sesión</a></li>
                        <li><a class="dropdown-item" href="/register">Crear Usuario</a></li> 
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/carrusel1.png') }}" class="d-block w-100" alt="Promoción 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/carrusel2.png') }}" class="d-block w-100" alt="Promoción 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/carrusel3.png') }}" class="d-block w-100" alt="Promoción 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>


    <main class="container mt-5 mb-5">
        <h2 class="text-center mb-4">Nuestro Catálogo</h2>
        
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
            
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/WheyProtein.jpeg') }}" class="card-img-top img-producto" alt="Producto 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$15.000</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/GoldStandardProtein.jpeg') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$22.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina.jpeg') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$24.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/vitaminD.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/colagenoHidrolizado.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/omega3.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/potasioMagnesio.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/guanteRosa.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/strapNegro.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/tobilleraNegra.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-primary w-100">Ver más</a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer>
      <div class="container-fluid bg-dark p-5">
      <div class= "row">
        <div class="col"><a href="#" class="text-decoration-none">Inicio</a>
        <div class="col"><a href="#" class="text-decoration-none">Términos y usos</a>
        <div class="col"><a href="#" class="text-decoration-none">Contacto</a>
        <div class="col"><a href="#" class="text-decoration-none"><i class="bi bi-instagram"></i>
        <div class="col"><a href="#" class="text-decoration-none"><i class="bi bi-facebook"></i>
        <div class="col"><a href="#" class="text-decoration-none"><i class="bi bi-whatsapp"></i>
        <i class="bi bi-envelope"></i>
        <i class="bi bi-geo-alt"></i>
      </div>
     </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>