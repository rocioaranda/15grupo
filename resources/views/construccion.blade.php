<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>En construcción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-black text-white d-flex align-items-center vh-100">

    <div class="container text-center">
        <div class="card bg-dark p-5 shadow-lg border-success" style="border-width: 2px;">
            
            <i class="bi bi-cone-striped text-success" style="font-size: 5rem;"></i> 
            
            <h1 class="text-success mt-3 mb-4">Lo sentimos</h1> 
            
            <p class="lead text-white-50">La página se encuentra en construcción.</p>
            
            <a href="{{ url('/') }}" class="btn btn-outline-success btn-lg mt-4">
                <i class="bi bi-arrow-left me-2"></i>Volver al Inicio
            </a>
            
        </div>
    </div>

</body>
</html>