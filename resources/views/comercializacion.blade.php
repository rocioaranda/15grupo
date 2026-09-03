@extends('layouts.app')

@section('main')

<!-- PRESENTACIÓN -->
<section class="text-center py-5">
    <h1 class="verde">Comercialización</h1>
    <p>Soluciones deportivas diseñadas para potenciar tu rendimiento y acompañar cada etapa de tu entrenamiento, con productos de calidad y respaldo profesional. </p>
</section>



<!-- BENEFICIOS -->
<section class="container py-5 text-center">

    <h2 class="mb-3">¿Por qué elegirnos?</h2>
    <p class="mb-5">
        Trabajamos con productos originales y seleccionados bajo estrictos estándares de calidad, brindando asesoramiento personalizado para ayudarte a alcanzar tus objetivos de forma eficiente y segura.
    </p>

    <div class="row justify-content-center">

        <div class="col-md-5 mb-4">
            <h4>🚚 Envíos</h4>
            <p>
                Ofrecemos retiro en nuestro local y envíos a todo el país, adaptándonos a tus necesidades. Contamos además con servicio de delivery para una experiencia de compra rápida y cómoda.
            </p>
        </div>

        <div class="col-md-5 mb-4">
            <h4>🔁 Devoluciones</h4>
            <p>
              Garantizamos tu tranquilidad: podés solicitar cambios dentro de los 3 días hábiles en caso de recibir un producto dañado o incorrecto, asegurando una solución rápida y efectiva.
            </p>
        </div>

    </div>
</section>

<!--  REDES SOCIALES -->
<section class="container py-5">
    <h2 class="text-center mb-4">Nuestras redes</h2>

    <div class="redes-container">

        <div class="red-item">
            <i class="fab fa-instagram"></i>
            <span>@Evolvex_Suplementos</span>
        </div>

        <div class="red-item">
            <i class="fab fa-facebook"></i>
            <span>EvolvexSuplementos</span>
        </div>

        <div class="red-item">
            <i class="fab fa-whatsapp"></i>
            <span>+541124096668</span>
        </div>
    </div>
</section>

<!-- MEDIOS DE PAGO -->
<section class="container py-5 text-white">
    <h2 class="text-center mb-4 text-white">Medios de pago</h2>

    <div class="row justify-content-center g-4 text-center">
        <div class="col-6 col-md-3">
            <i class="bi bi-credit-card-2-front-fill text-success fs-2 d-block mb-2"></i>
            <span class="d-block fw-bold text-white">Tarjeta de crédito</span>
            <small class="text-white-50">Visa, Mastercard, American Express</small>
        </div>

        <div class="col-6 col-md-3">
            <i class="bi bi-credit-card-fill text-success fs-2 d-block mb-2"></i>
            <span class="d-block fw-bold text-white">Tarjeta de débito</span>
            <small class="text-white-50">Visa Débito, Maestro</small>
        </div>

        <div class="col-6 col-md-3">
            <i class="bi bi-bank text-success fs-2 d-block mb-2"></i>
            <span class="d-block fw-bold text-white">Transferencia</span>
            <small class="text-white-50">CBU / Alias</small>
        </div>

        <div class="col-6 col-md-3">
            <i class="bi bi-cash-coin text-success fs-2 d-block mb-2"></i>
            <span class="d-block fw-bold text-white">Efectivo</span>
            <small class="text-white-50">Retiro en local</small>
        </div>
    </div>

    <p class="text-center text-white-50 small mt-4">
        <i class="bi bi-shield-lock-fill text-success me-1"></i>
        Todos tus pagos están protegidos y son 100% seguros.
    </p>
</section>

<!-- IMAGEN DESTACADA -->
<section class="container py-4 text-center">
    <img src="{{ asset('img/comer.jpeg') }}" class="img-fluid imagen-banner">
</section>

<!-- UBICACIÓN -->
<a href="https://maps.app.goo.gl/7dnuvanJA8J4AoGv7" target="_blank" style="text-decoration:none;">
    <section class="container py-5 text-center">
        <h2 class="verde mb-3">Visitá nuestro local</h2>
        <img src="{{ asset('img/ubi.png') }}" class="logo-ubi">
        <p>Te esperamos en nuestro local...</p>
    </section>
</a>

@endsection