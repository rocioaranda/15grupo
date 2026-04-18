<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    
</head>

<body>
    <header class="header-banner">
      <img src="{{ asset('img/logo1.jpeg') }}" alt="Banner Principal" class="img-banner">
    </header>
    
    <main class="container mt-1">
    </main>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="Buscar" placeholder="¿Qué estás buscando?" aria-label="Buscar"/>
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>


<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
    <div class="carousel-item active" style="max heigh: 300px";>
      <img src="{{ asset('img/carrusel1.png') }}" class="d-block w-100" alt="Promoción 1">
    </div>
    <div class="carousel-item" style="max heigh: 300px";>
      <img src="{{ asset('img/carrusel2.png') }}" class="d-block w-100" alt="Promoción 2">
    </div>
    <div class="carousel-item" >
      <img src="{{ asset('img/carrusel3.png') }}" class="d-block w-100" alt="Promoción 3">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-4">
  <div class="row">
    <div class="col">
      <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  </div>
  </div>
  <div class="col">
      <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  </div>
  </div>
  <div class="col">
      <div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Nuestro Catálogo</h2>
    
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
        
        <div class="col">
            <div class="card h-100 shadow-lg border-0">
                <img src="{{ asset('img/producto1.jpg') }}" class="card-img-top img-producto" alt="Producto 1">
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
                <img src="{{ asset('img/producto2.jpg') }}" class="card-img-top img-producto" alt="Producto 2">
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
                <img src="{{ asset('img/producto3.jpg') }}" class="card-img-top img-producto" alt="Producto 3">
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
                <img src="{{ asset('img/producto4.jpg') }}" class="card-img-top img-producto" alt="Producto 4">
                <div class="card-body text-center">
                    <h5 class="card-title">Nombre del Producto</h5>
                    <p class="card-text text-muted">Breve descripción del artículo.</p>
                    <p class="fw-bold fs-5 text-success">$2.500</p>
                    <a href="#" class="btn btn-primary w-100">Ver más</a>
                </div>
            </div>
        </div>

        </div>
</div>
</body>
</html>