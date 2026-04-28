@extends('layouts.app')

@section('main')

<!-- 🎯 PRESENTACIÓN -->
<section class="text-center py-5">
    <h1 class="verde">Comercialización</h1>
    <p>Productos deportivos diseñados para mejorar tu rendimiento </p>
</section>



<!-- 💡 BENEFICIOS -->
<section class="container text-center py-5">
    <h2 class="verde">¿Por qué elegirnos?</h2>
    <p>
        Calidad garantizada, productos originales y asesoramiento personalizado para potenciar tu rendimiento.
    </p>
</section>

<section class="container py-5 text-center">

    <h2 class="mb-3">¿Por qué elegirnos?</h2>
    <p class="mb-5">
        Calidad garantizada, productos originales y asesoramiento personalizado para potenciar tu rendimiento.
    </p>

    <div class="row justify-content-center">

        <div class="col-md-5 mb-4">
            <h4>🚚 Envíos</h4>
            <p>
                Ofrecemos retiro en nuestro local y envíos a todo el país. También contamos con servicio de delivery.
            </p>
        </div>

        <div class="col-md-5 mb-4">
            <h4>🔁 Devoluciones</h4>
            <p>
                Aceptamos cambios dentro de los 3 días hábiles en caso de productos dañados o incorrectos.
            </p>
        </div>

    </div>

</section>


<!-- 📍 UBICACIÓN -->
 <a href="https://maps.app.goo.gl/7dnuvanJA8J4AoGv7" target="_blank" style="text-decoration:none;">
    <section class="container py-5 text-center">
        <h2 class="verde mb-3">Visitá nuestro local</h2>
        <img src="{{ asset('img/ubi.png') }}" class="logo-ubi">
        <p>Te esperamos en nuestro local...</p>
    </section>
</a>


<!-- 📩 CONTACTO -->
<section class="container py-5">
    <h2 class="text-center verde mb-4">Contacto</h2>

    <form>
        <input class="form-control mb-2" placeholder="Nombre">
        <input class="form-control mb-2" placeholder="Email">
        <textarea class="form-control mb-2" placeholder="Mensaje"></textarea>
        <button class="btn btn-verde">Enviar</button>
    </form>
</div>
</section>

@endsection