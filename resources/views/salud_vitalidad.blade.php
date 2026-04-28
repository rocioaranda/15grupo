@extends('layouts.app')

@section('main')
<div class="container py-5">
    <h2 class="text-success fw-bold mb-4 text-center">Salud y vitalidad</h2>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/gold-multivitamina.webp') }}" class="card-img-top img-producto" alt="Producto 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">GOLD MULTIVITAMINICO X 30 CAPS</h5>
                        <p class="fw-bold fs-5 text-success">$21.500</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/star-vitamina.webp') }}" class="card-img-top img-producto" alt="Producto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">VITAMINA X 60 CAPS - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$2.400</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/vitamina-mervick.webp') }}" class="card-img-top img-producto" alt="Producto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">MULTIVITAMINICO MERVICK - 120 CAPS</h5>
                        <p class="fw-bold fs-5 text-success">$17.091</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/vitamina-advance.webp') }}" class="card-img-top img-producto" alt="Producto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">VITAMINA C BODY ADVANCE</h5>
                        <p class="fw-bold fs-5 text-success">$14.000</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/zma-gold.webp') }}" class="card-img-top img-producto" alt="Producto 5">
                    <div class="card-body text-center">
                        <h5 class="card-title">ZMA GOLD NUTRITION X 90 CAPS</h5>
                        <p class="fw-bold fs-5 text-success">$17.900</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/zma-star.webp') }}" class="card-img-top img-producto" alt="Producto 6">
                    <div class="card-body text-center">
                        <h5 class="card-title">ZMA STAR NUTRITION X 90 CAPS</h5>
                        <p class="fw-bold fs-5 text-success">$26.000</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div> 

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/colagenoHidrolizado.jpeg') }}" class="card-img-top img-producto" alt="Producto 7">
                    <div class="card-body text-center">
                        <h5 class="card-title">COLAGENO HIDROLIZADO 360G - ENA</h5>
                        <p class="fw-bold fs-5 text-success">$30.185</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/colageno-granger.webp') }}" class="card-img-top img-producto" alt="Producto 8">
                    <div class="card-body text-center">
                        <h5 class="card-title">COLAGENO BEAUTY 250 GR GRANGER</h5>
                        <p class="fw-bold fs-5 text-success">$13.367</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/colageno-sport.webp') }}" class="card-img-top img-producto" alt="Producto 9">
                    <div class="card-body text-center">
                        <h5 class="card-title">COLAGENO SPORT 407 G - ENA</h5>
                        <p class="fw-bold fs-5 text-success">$29.410</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

             <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/colageno-polvo.webp') }}" class="card-img-top img-producto" alt="Producto 10">
                    <div class="card-body text-center">
                        <h5 class="card-title">COLAGENO EN POLVO AGE BIOLOGIQUE</h5>
                        <p class="fw-bold fs-5 text-success">$32.100</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/colageno-advance.webp') }}" class="card-img-top img-producto" alt="Producto 11">
                    <div class="card-body text-center">
                        <h5 class="card-title">COLAGENO BODY ADVANCE</h5>
                        <p class="fw-bold fs-5 text-success">$24.500</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/colageno-hialuronico.webp') }}" class="card-img-top img-producto" alt="Producto 12">
                    <div class="card-body text-center">
                        <h5 class="card-title">COLAGENO HIDROLIZADO HIALURÓNICO X 60 CAPS</h5>
                        <p class="fw-bold fs-5 text-success">$15.400</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

         <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/omega3.jpeg') }}" class="card-img-top img-producto" alt="Producto 13">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMEGA 3 MAX X 60 CAPS - INNOVANATURALS</h5>
                        <p class="fw-bold fs-5 text-success">$92.169</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/omega-ena.webp') }}" class="card-img-top img-producto" alt="Producto 14">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMEGA 3 X 60 CAPS - ENA SPORT</h5>
                        <p class="fw-bold fs-5 text-success">$27.105</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/omega-fit.webp') }}" class="card-img-top img-producto" alt="Producto 15">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMEGA 3 X 30 CAPS - ONE FIT NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$19.900</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/omega-gold.webp') }}" class="card-img-top img-producto" alt="Producto 16">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMEGA 3 MAX X 30 CAPS - GOLD NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$29.675</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/omega-star.webp') }}" class="card-img-top img-producto" alt="Producto 17">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMEGA 3 MAX X 60 CAPS - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$33.280</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

              <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/citrato-gold.webp') }}" class="card-img-top img-producto" alt="Producto 18">
                    <div class="card-body text-center">
                        <h5 class="card-title">CITRATO DE MAGNESIO - GOLD NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$19.400</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/citrato-star.webp') }}" class="card-img-top img-producto" alt="Producto 19">
                    <div class="card-body text-center">
                        <h5 class="card-title">CITRATO DE MAGNESIO X 60 CAPS - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$24.600</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/citrato-star-gr.webp') }}" class="card-img-top img-producto" alt="Producto 20">
                    <div class="card-body text-center">
                        <h5 class="card-title">CITRATO DE MAGNESIO 500 GR - STAR NUTRITION</h5>
                        <p class="fw-bold fs-5 text-success">$34.466</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/pancakeProteico.webp') }}" class="card-img-top img-producto" alt="Producto 21">
                    <div class="card-body text-center">
                        <h5 class="card-title">PANCAKE PROTEICO GRANGER</h5>
                        <p class="fw-bold fs-5 text-success">$17.962</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/cupcakeProteico.webp') }}" class="card-img-top img-producto" alt="Producto 22">
                    <div class="card-body text-center">
                        <h5 class="card-title">CUPCAKE PROTEICO GRANGER</h5>
                        <p class="fw-bold fs-5 text-success">$16.421</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/omeletteProteico.webp') }}" class="card-img-top img-producto" alt="Producto 23">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMELETTE PROTEICO GRANGER</h5>
                        <p class="fw-bold fs-5 text-success">$15.916</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/pulverOmelette.webp') }}" class="card-img-top img-producto" alt="Producto 24">
                    <div class="card-body text-center">
                        <h5 class="card-title">OMELETTE PROTEICO PULVER 500 GR</h5>
                        <p class="fw-bold fs-5 text-success">$45.500</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/pulverCapuccino.webp') }}" class="card-img-top img-producto" alt="Producto 25">
                    <div class="card-body text-center">
                        <h5 class="card-title">PULVER CAPUCCINO 500 GR</h5>
                        <p class="fw-bold fs-5 text-success">$40.050</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-lg border-0">
                    <img src="{{ asset('img/saludVitalidad/chiaPudding.webp') }}" class="card-img-top img-producto" alt="Producto 26">
                    <div class="card-body text-center">
                        <h5 class="card-title">CHIA PUDDING PROTEICO</h5>
                        <p class="fw-bold fs-5 text-success">$12.940</p>
                        <a href="#" class="btn btn-success w-100" style="pointer-events: none; cursor: default;">Comprar</a>
                    </div>
                </div>
            </div>
@endsection       