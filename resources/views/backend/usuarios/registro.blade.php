@extends('layouts.app')

@section('main')
<main class="container py-5 d-flex justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card bg-dark text-white shadow-lg border-0 p-4">
            
            <h2 class="text-center fw-bold mb-4 text-success">Crear Cuenta</h2>
            <p class="text-muted text-center mb-4">Registrate para gestionar tus compras en Evolvex</p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <!-- Nombre y Apellido -->
                <div class="mb-3">
                    <label for="nombre_apellido" class="form-label">Nombre y Apellido</label>
                    <input type="text" name="nombre_apellido" value="{{ old('nombre_apellido') }}" 
                           class="form-control bg-secondary text-white border-0 shadow-none @error('nombre_apellido') is-invalid @enderror" id="nombre_apellido" required>
                    @error('nombre_apellido')
                        <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="form-control bg-secondary text-white border-0 shadow-none @error('email') is-invalid @enderror" id="email" required>
                    @error('email')
                        <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" 
                           class="form-control bg-secondary text-white border-0 shadow-none @error('telefono') is-invalid @enderror" id="telefono" required>
                    @error('telefono')
                        <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" 
                           class="form-control bg-secondary text-white border-0 shadow-none @error('password') is-invalid @enderror" id="password" required>
                    @error('password')
                        <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmar Contraseña (Usa password_confirmation para que Laravel lo valide solo) -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" 
                           class="form-control bg-secondary text-white border-0 shadow-none" id="password_confirmation" required>
                </div>
                <!-- Botón de Envío -->
                <button type="submit" class="btn btn-success btn-lg w-100 mt-2 fw-bold shadow-none">
                    Registrarse
                </button>
            </form>

        </div>
    </div>
</main>
@endsection