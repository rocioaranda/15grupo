@extends('layouts.app')

@section('main')
<div class="container py-5">
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/gold-multivitamina.webp') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">GOLD MULTIVITAMINICO X 30 CAPS</h5>
                <p class="producto-precio">$21.500</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/star-vitamina.webp') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">VITAMINA X 60 CAPS - STAR NUTRITION</h5>
                <p class="producto-precio">$2.400</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/vitamina-mervick.webp') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">MULTIVITAMINICO MERVICK - 120 CAPS</h5>
                <p class="producto-precio">$17.091</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/vitamina-advance.webp') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">VITAMINA C BODY ADVANCE</h5>
                <p class="producto-precio">$14.000</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/zma-gold.webp') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">ZMA GOLD NUTRITION X 90 CAPS</h5>
                <p class="producto-precio">$17.900</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/zma-star.webp') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">ZMA STAR NUTRITION X 90 CAPS</h5>
                <p class="producto-precio">$26.000</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="producto-card">
            <img src="{{ asset('img/saludVitalidad/colagenoHidrolizado.jpeg') }}" class="producto-img" alt="Producto">
            <div class="card-body text-center">
                <h5 class="producto-titulo">COLAGENO HIDROLIZADO 360G - ENA</h5>
                <p class="producto-precio">$30.185</p>
                <span class="btn producto-btn">Comprar</span>
            </div>
        </div>
    </div>
<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/colageno-granger.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">COLAGENO BEAUTY 250 GR GRANGER</h5>
            <p class="producto-precio">$13.367</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/colageno-sport.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">COLAGENO SPORT 407 G - ENA</h5>
            <p class="producto-precio">$29.410</p>
           <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/colageno-polvo.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">COLAGENO EN POLVO AGE BIOLOGIQUE</h5>
            <p class="producto-precio">$32.100</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/colageno-advance.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">COLAGENO BODY ADVANCE</h5>
            <p class="producto-precio">$24.500</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/colageno-hialuronico.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">COLAGENO HIDROLIZADO HIALURÓNICO X 60 CAPS</h5>
            <p class="producto-precio">$15.400</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/omega3.jpeg') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMEGA 3 MAX X 60 CAPS - INNOVANATURALS</h5>
            <p class="producto-precio">$92.169</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/omega-ena.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMEGA 3 X 60 CAPS - ENA SPORT</h5>
            <p class="producto-precio">$27.105</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/omega-fit.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMEGA 3 X 30 CAPS - ONE FIT NUTRITION</h5>
            <p class="producto-precio">$19.900</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/omega-gold.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMEGA 3 MAX X 30 CAPS - GOLD NUTRITION</h5>
            <p class="producto-precio">$29.675</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/omega-star.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMEGA 3 MAX X 60 CAPS - STAR NUTRITION</h5>
            <p class="producto-precio">$33.280</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/citrato-gold.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">CITRATO DE MAGNESIO - GOLD NUTRITION</h5>
            <p class="producto-precio">$19.400</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/citrato-star.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">CITRATO DE MAGNESIO X 60 CAPS - STAR NUTRITION</h5>
            <p class="producto-precio">$24.600</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/citrato-star-gr.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">CITRATO DE MAGNESIO 500 GR - STAR NUTRITION</h5>
            <p class="producto-precio">$34.466</p>
            <span class="btn producto-btn">Comprar</span>>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/pancakeProteico.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">PANCAKE PROTEICO GRANGER</h5>
            <p class="producto-precio">$17.962</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/cupcakeProteico.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">CUPCAKE PROTEICO GRANGER</h5>
            <p class="producto-precio">$16.421</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/omeletteProteico.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMELETTE PROTEICO GRANGER</h5>
            <p class="producto-precio">$15.916</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/pulverOmelette.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">OMELETTE PROTEICO PULVER 500 GR</h5>
            <p class="producto-precio">$45.500</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/pulverCapuccino.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">PULVER CAPUCCINO 500 GR</h5>
            <p class="producto-precio">$40.050</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/chiaPudding.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">CHIA PUDDING PROTEICO</h5>
            <p class="producto-precio">$12.940</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/pancake-salado.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">PANCAKE PROTEICOS SALADO SABOR QUESO 300 gr- GRANGER</h5>
            <p class="producto-precio">$17.951</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/saludVitalidad/pancake-vegan.webp') }}" class="producto-img" alt="Producto">
        <div class="card-body text-center">
            <h5 class="producto-titulo">VEGAN PANCAKES PROTEICOS SABOR CHOCOLATE 400G</h5>
            <p class="producto-precio">$17.503</p>
            <span class="btn producto-btn">Comprar</span>
        </div>
    </div>
</div>

</div>
    </div>
     

@endsection