<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success fw-bold mb-0 text-uppercase">Lo más vendido</h2>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success rounded-circle shadow-none" type="button" data-bs-target="#carouselEvolvex" data-bs-slide="prev">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-outline-success rounded-circle shadow-none" type="button" data-bs-target="#carouselEvolvex" data-bs-slide="next">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>

    <div id="carouselEvolvex" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="producto-card">
                            <img src="{{ asset('img/aumentoMasa/whey-protein-doypack.webp') }}" class="producto-img">
                            <div class="card-body text-center">
                                <h5 class="producto-titulo">WHEY PROTEIN DOYPACK - 2 LBS STAR NUTRITION</h5>
                                <p class="producto-precio">$45.000</p>
                                <a href="#" class="btn producto-btn">Comprar</a>
                            </div>
                        </div>
                    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/aumentoMasa/WheyProtein.jpeg') }}" class="producto-img">
            <div class="card-body text-center">
                <h5 class="producto-titulo">WHEY PLATINUM 2LB - STAR NUTRITION</h5>
                <p class="producto-precio">$50.000</p>
                <a href="#" class="btn producto-btn">Comprar</a>
            </div>
        </div>
    </div>

                    <div class="col">
                        <div class="producto-card">
                            <img src="{{ asset('img/aumentoMasa/creatinaMono.webp') }}" class="producto-img">
                            <div class="card-body text-center">
                                <h5 class="producto-titulo">CREATINA 300GR DOYPACK - STAR NUTRITION</h5>
                                <p class="producto-precio">$28.000</p>
                                <a href="#" class="btn producto-btn">Comprar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="producto-card">
                            <img src="{{ asset('img/aumentoMasa/creatina-ena.webp') }}" class="producto-img">
                            <div class="card-body text-center">
                                <h5 class="producto-titulo">CREATINA MICRONIZADA ENA - 300GR</h5>
                                <p class="producto-precio">$31.157</p>
                                <a href="#" class="btn producto-btn">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div> </div> <div class="carousel-item">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="producto-card">
                            <img src="{{ asset('img/saludVitalidad/pancakeProteico.webp') }}" class="producto-img">
                            <div class="card-body text-center">
                                <h5 class="producto-titulo">PANCAKE PROTEICO GRANGER</h5>
                                <p class="producto-precio">$17.962</p>
                                <a href="#" class="btn producto-btn">Comprar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="producto-card">
                            <img src="{{ asset('img/saludVitalidad/citrato-gold.webp') }}" class="producto-img">
                            <div class="card-body text-center">
                                <h5 class="producto-titulo">CITRATO DE MAGNESIO - GOLD NUTRITION</h5>
                                <p class="producto-precio">$19.400</p>
                                <a href="#" class="btn producto-btn">Comprar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="producto-card">
                            <img src="{{ asset('img/saludVitalidad/vitamina-advance.webp') }}" class="producto-img">
                            <div class="card-body text-center">
                                <h5 class="producto-titulo">VITAMINA C BODY ADVANCE</h5>
                                <p class="producto-precio">$14.000</p>
                                <a href="#" class="btn producto-btn">Comprar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                    <div class="producto-card">
                         <img src="{{ asset('img/accesorios/vendas-rodillas.webp') }}" class="producto-img">
                         <div class="card-body text-center">
                         <h5 class="producto-titulo">VENDAS DE RODILLAS 250CM</h5>
                         <p class="producto-precio">$63.288</p>
                         <a href="#" class="btn producto-btn">Comprar</a>
                    </div>
                  </div>
                </div>


                </div> 
            </div> 
        </div> 
    </div> 
    
    <div class="text-center mt-5">
             <a href="{{ url('/catalogo') }}" class="btn btn-outline-success btn-lg px-5 fw-bold rounded-pill shadow-none text-uppercase">
            Mostrar todos los productos
        </a>
    </div>
</div>