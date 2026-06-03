@extends('layouts.app')

@section('main')
<main class="container py-5 d-flex justify-content-center">
    <div class="col-12 col-md-8 col-lg-5">
        <div class="card bg-dark text-white shadow-lg border-0 p-4">
            
            <h2 class="text-center fw-bold mb-4 text-success">Iniciar Sesión</h2>
            <p class="text-muted text-center mb-4">Ingresá a tu cuenta de Evolvex</p>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="form-control bg-secondary text-white border-0 shadow-none @error('email') is-invalid @enderror" id="email" required autofocus>
                    @error('email')
                        <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" 
                           class="form-control bg-secondary text-white border-0 shadow-none" id="password" required>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label text-muted" for="remember">Recordar mi sesión</label>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow-none">
                    Ingresar
                </button>
                
                <div class="text-center mt-4">
                    <p class="text-muted mb-0">¿No tenés cuenta? <a href="{{ route('register') }}" class="text-success text-decoration-none fw-bold">Registrate acá</a></p>
                </div>
            </form>

        </div>
    </div>
</main>
@endsection