@extends('layouts.app')

@section('main')

<!-- 🎯 PRESENTACIÓN -->
<section class="text-center py-5">
    <h1 class="verde">Comercialización</h1>
    <p>Productos deportivos diseñados para mejorar tu rendimiento </p>
</section>


<!-- 🛍️ PRODUCTOS -->
<section class="py-5">
     <div class="container">
    <h2 class="text-center verde mb-4">Nuestros productos</h2>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card text-center p-3">
                <img src="{{ asset('img/prod1.jpg') }}" class="img-fluid">
                <h5 class="mt-3">Pre-entreno</h5>
                <p>Aumenta energía y enfoque</p>
                <button class="btn btn-verde">Ver más</button>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-center p-3">
                <img src="{{ asset('img/prod2.jpg') }}" class="img-fluid">
                <h5 class="mt-3">Quemador</h5>
                <p>Apoya la pérdida de grasa</p>
                <button class="btn btn-verde">Ver más</button>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-center p-3">
                <img src="{{ asset('img/prod3.jpg') }}" class="img-fluid">
                <h5 class="mt-3">Accesorios</h5>
                <p>Guantes, cinturones y más</p>
                <button class="btn btn-verde">Ver más</button>
            </div>
        </div>

    </div>
</section>


<!-- 💡 BENEFICIOS -->
<section class="container text-center py-5">
    <h2 class="verde">¿Por qué elegirnos?</h2>
    <p>
        Calidad garantizada, productos originales y asesoramiento personalizado.
    </p>
</section>


<!-- 🚚 ENVÍOS Y DEVOLUCIONES -->
<section class="container py-5">
    <h2 class="text-center verde mb-4">Envíos y devoluciones</h2>

    <div class="row text-center">

        <div class="col-md-6">
            <h5>Envíos</h5>
            <p>
                Entregas en puntos físicos y envíos a todo el país.
                También contamos con servicio de delivery.
            </p>
        </div>

        <div class="col-md-6">
            <h5>Devoluciones</h5>
            <p>
                Cambios dentro de los 3 días hábiles ante productos dañados,
                incorrectos o en mal estado.
            </p>
        </div>

    </div>
</section>


<!-- 📍 UBICACIÓN -->
<section class="container py-5 text-center">
    <h2 class="verde mb-3">Encontra el punto de venta</h2>
    <img src="{{ asset('img/ubi.png') }}">
    <p>Te esperamos en nuestro local para brindarte la mejor atencion personalizada y todos los productos que necesitas para tu rendimiento deportivo.</p>
</section> 


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