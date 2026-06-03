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
                
                <form action="{{ route('contacto.enviar') }}" method="POST">
                    @csrf <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold small text-success">NOMBRE Y APELLIDO</label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control bg-dark text-white border-secondary shadow-none @error('nombre') border-danger @enderror" 
                               required value="{{ old('nombre') }}" placeholder="">
                        @error('nombre')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-success">CORREO ELECTRÓNICO</label>
                        <input type="email" name="email" id="email" 
                               class="form-control bg-dark text-white border-secondary shadow-none @error('email') border-danger @enderror" 
                               required value="{{ old('email') }}" placeholder="">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="mensaje" class="form-label fw-bold small text-success">TU CONSULTA O MENSAJE</label>
                        <textarea name="mensaje" id="mensaje" rows="4" 
                                  class="form-control bg-dark text-white border-secondary shadow-none @error('mensaje') border-danger @enderror" 
                                  required placeholder="">{{ old('mensaje') }}</textarea>
                        @error('mensaje')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success fw-bold px-5 py-2 shadow-none float-end">
                        <i class="bi bi-send me-2"></i> Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection