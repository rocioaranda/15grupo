<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-black text-white d-flex align-items-center vh-100">
    <div class="container text-center">
        <div class="card bg-dark p-5 shadow-lg border-success">
           <h1 class="text-success mb-4">¡Mensaje Enviado!</h1> 
           <p class="lead text-white"> Hola <strong class="text-success">{{ $nombre }}</strong>, qué bueno recibir tu mensaje. 
        Un miembro del equipo de ventas se pondrá en contacto con vos al correo: 
        <strong class="text-success">{{ $email }}</strong>. ¡Muchas gracias! 
    </p>
            <a href="{{ url('/') }}" class="btn btn-outline-success mt-4">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>


    