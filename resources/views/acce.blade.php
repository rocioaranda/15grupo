@extends('layouts.app')
@section('main')
<div class="container py-5">
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">

    <div class="col">
        <div class="producto-card">
            
            <img src="{{ asset('img/accesorios/strapNegro.jpeg') }}" class="producto-img" alt="Producto">

            <div class="card-body text-center">
                <h5 class="producto-titulo">
                    STRAP NEGRO
                </h5>

                <p class="producto-precio">$45.000</p>

                <a href="#" class="btn producto-btn">
                    Comprar
                </a>
            </div>
                 </div>
    </div>

    <div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/guanteRosa.jpeg') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">GUANTE DEPORTIVO</h5>
            <p class="producto-precio">$12.500</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/tobilleraNegra.jpeg') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">TOBILLERA PARA POLEA</h5>
            <p class="producto-precio">$19.950</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/tobillera-neoprene.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">TOBILLERAS NEOPRENE</h5>
            <p class="producto-precio">$23.340</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/cinturon-fuerza-negro.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">CINTURÓN DE FUERZA</h5>
            <p class="producto-precio">$57.331</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/vendas-ridollas.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">VENDAS DE RODILLAS 250CM</h5>
            <p class="producto-precio">$63.288</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/muñequera-elastica.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">MUÑEQUERA ELÁSTICA</h5>
            <p class="producto-precio">$17.590</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/banda-larga-tensionM.png') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">BANDA CON MANIJA TENSIÓN MEDIA</h5>
            <p class="producto-precio">$14.791</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/banda-funcional.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">BANDA FUNCIONAL TENSIÓN MEDIA</h5>
            <p class="producto-precio">$38.411</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/banda-asistencia.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">BANDA DE ASISTENCIA 3.2</h5>
            <p class="producto-precio">$34.104</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/banda-asistencia-6.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">BANDA DE ASISTENCIA 6.4</h5>
            <p class="producto-precio">$67.000</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/push-up-flex.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">PUSH-UP / FLEXIONES DE BRAZOS</h5>
            <p class="producto-precio">$19.744</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>

<div class="col">
    <div class="producto-card">
        <img src="{{ asset('img/accesorios/colchoneta.webp') }}" class="producto-img">
        <div class="card-body text-center">
            <h5 class="producto-titulo">COLCHONETA ALTA DENSIDAD</h5>
            <p class="producto-precio">$55.566</p>
            <a href="#" class="btn producto-btn">Comprar</a>
        </div>
    </div>
</div>
        </div>
    </div>

@endsection

            

