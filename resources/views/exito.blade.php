@extends('layouts.app')

@section('main')
<main class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card bg-dark p-5 shadow-lg border-success">
                <h1 class="text-success mb-4 fw-bold">¡Mensaje Enviado!</h1>
            <p class="lead text-white"> Hola <strong class="text-success">{{ $nombre }}</strong>, qué bueno recibir tu mensaje. 
             Un miembro del equipo de ventas se pondrá en contacto con vos al correo: 
            <strong class="text-success">{{ $email }}</strong>. ¡Muchas gracias! 
             </p>
            <a href="{{ url('/') }}" class="btn btn-outline-success mt-4">Volver al Inicio</a>
          </div>
       </div>
    </div>
 </div>   
</main>
@endsection


    