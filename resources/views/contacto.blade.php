<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body class="bg-black text-white">

    <main class="container mt-5">
        <div class="row g-5">
            
            <div class="col-md-4">
                <h3 class="mb-4 text-success border-bottom pb-2">Información de Contacto</h3>
                <div class="d-flex flex-column gap-4">
                    
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-whatsapp fs-2 text-success"></i>
                        <div>
                            <p class="mb-0 fw-bold">WhatsApp</p>
                            <a class="text-white-50 text-decoration-none">+54 1234</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-envelope-at fs-2 text-success"></i>
                        <div>
                            <p class="mb-0 fw-bold">Email</p>
                            <span class="text-white-50">contacto@gmail.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-geo-alt fs-2 text-success"></i>
                        <div>
                            <p class="mb-0 fw-bold">Dirección</p>
                            <span class="text-white-50"> Corrientes, Argentina</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="card bg-dark text-white shadow-lg border-0 p-4">
                 <form action="{{ url('/contacto') }}" method="POST">
        @csrf
         <div class="mb-3">
            <label class="form-label">Nombre</label>
           <input type="text" name="nombre" class="form-control bg-secondary text-white border-0" id="nombre" required>
         </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control bg-secondary text-white border-0" id="email" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mensaje</label>
        <textarea name="mensaje" class="form-control bg-secondary text-white border-0" id="mensaje" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-lg w-100 mt-3">Enviar Mensaje</button>
</div>
</form>

                    </form>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>