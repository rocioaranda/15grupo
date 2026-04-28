@extends('layouts.app')

@section('main')
<main class="container py-5">
    <div class="row g-5">
        
        <div class="col-12 col-md-4">
            <h3 class="mb-4 text-success border-bottom pb-2 fw-bold">Información de Contacto</h3>
            
            <div class="d-flex flex-column gap-4">
                
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-whatsapp fs-2 text-success"></i>
                    <div>
                        <p class="mb-0 fw-bold text-white">WhatsApp</p>
                        <span class="text-white-50">+54 11 2409-6668</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-envelope-at fs-2 text-success"></i>
                    <div>
                        <p class="mb-0 fw-bold text-white">Email</p>
                        <span class="text-white-50">evolvex_suplementos@gmail.com</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-geo-alt fs-2 text-success"></i>
                    <div>
                        <p class="mb-0 fw-bold text-white">Dirección</p>
                        <span class="text-white-50">Muñiz 1900, Buenos Aires, Argentina</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                   <i class="bi bi-instagram fs-2 text-success"></i><i class="bi bi-facebook fs-2 text-success"></i>
                   <div>
                       <p class="mb-0 fw-bold text-white">Instagram</p>
                       <span class="text-white-50">Evolvex Suplementos</span>
                   </div>
                </div>

            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card bg-dark text-white shadow-lg border-0 p-4">
                <form action="{{ url('/contacto') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control bg-secondary text-white border-0 shadow-none" id="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control bg-secondary text-white border-0 shadow-none" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea name="mensaje" class="form-control bg-secondary text-white border-0 shadow-none" id="mensaje" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 mt-3 fw-bold shadow-none">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection