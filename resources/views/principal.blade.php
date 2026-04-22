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
            <li><a class="dropdown-item" href="/login">Iniciar Sesión</a></li>
            <li><a class="dropdown-item" href="/register">Crear Usuario</a></li> 
          </ul>
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
                    <img src="{{ asset('img/whey-protein-doypack.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">WHEY PROTEIN DOYPACK - 2 LBS STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$45.000</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/WheyProtein.jpeg') }}" class="card-img-top img-producto" alt="Producto 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">WHEY PLATINUM 2LB - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$50.000</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/GoldStandardProtein.jpeg') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">PROTEINA 100% GOLD STANDARD WHEY - OPTIMUM NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$85.500</p>
                        <<a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/advance-whey-protein-907g-vainilla.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">WHEY PROTEIN BODY ADVANCE - 907 GRS</h5>
                        <p class="fw-bold fs-5 text-success">$25.449</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/platinum-nitro-whey.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">PLATINUM NITRO WHEY 2 LBS - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$58.381</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/whey-protein-truemade.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">WHEY PROTEIN TRUE MADE ENA - 453 G</h5>
                        <p class="fw-bold fs-5 text-success">$35.583</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

             <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/prote-vegetal.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">VEGETAL PROTEIN ISOLATE 2 lbs - GOLD NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$33.666</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

             <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/vegetal-iso.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">ISO VEGETAL PROTEIN 910 G - BODY ADVANCE</h5>
                        <p class="fw-bold fs-5 text-success">$27.498</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatinaMono.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINA 300GR DOYPACK - STAR NUTRIRION</h5>
                        <p class="fw-bold fs-5 text-success">$28.000</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-micronizada.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">DOYPACK CREATINA MICRONIZADA 300GR - NUTREMAX</h5>
                        <p class="fw-bold fs-5 text-success">$25.459</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

             <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-ena.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINA MICRONIZADA ENA - 300GR</h5>
                        <p class="fw-bold fs-5 text-success">$31.157</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-creapure.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINA MICRONIZADA CREAPURE 200g - ENA</h5>
                        <p class="fw-bold fs-5 text-success">$48.414</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

             <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-gold.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINE MONOHYDRATE 300 g - GOLD NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$28.565</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

             <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-granger.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINA GRANGER - 300 G</h5>
                        <p class="fw-bold fs-5 text-success">$31.823</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-powder.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINA MICRONIZED POWDER 300GRS - OPTIMUM NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$39.174</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/creatina-hardcore.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">CREATINA HARDCORE 300G- INTEGRALMEDICA</h5>
                        <p class="fw-bold fs-5 text-success">$39.329</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/vitaminD.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/colagenoHidrolizado.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/omega3.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/potasioMagnesio.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/pancakeProteico.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/pancakeProteico.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/omeletteProteico.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/pulverOmelette.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/pulverCapuccino.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/chiaPudding.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/thermo-fuel.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="card-text text-muted">Breve descripción del artículo.</p>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/banda-larga-tensionM.png') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/cinturon-fuerza-negro.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/colchoneta.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/tobillera-neoprene.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/strapNegro.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/guanteRosa.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/tobilleraNegra.jpeg') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Nombre del Producto</h5>
                        <p class="fw-bold fs-5 text-success">$12.500</p>
                        <a href="#" class="btn btn-success w-100">Comprar</a>
                    </div>
                </div>
            </div>

        </div>
    </main>


   <footer>
    <div class="container-fluid bg-dark p-5">
        <div class="row text-center"> <div class="col">
                <a href="{{ url('/') }}" class="text-decoration-none text-success fw-bold">Inicio</a>
            </div>
            <div class="col">
                <a href="#" class="text-decoration-none text-success fw-bold">Términos y usos</a>
            </div>
            <div class="col">
                <a href="{{ url('/contacto') }}" class="text-decoration-none text-success fw-bold">Contacto</a>
            </div>

            <div class="col">
                <a href="#" class="text-decoration-none text-success fs-4 me-3"><i class="bi bi-instagram"></i>
                <a href="#" class="text-decoration-none text-success fs-4 me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-decoration-none text-success fs-4 me-3"><i class="bi bi-whatsapp"></i></a>
            </div>

            <div class="col">
                <i class="bi bi-envelope text-success fs-4 me-3"></i>
                <i class="bi bi-geo-alt text-success fs-4"></i>
            </div>

        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>