<!-- 🛍️ CATÁLOGO -->
 @extends('layouts.app')
 @section('main')

    <h2 class="text-center mb-5 text-success fw-bold">Nuestro Catálogo</h2>

    @include('aumento_masa')
    @include('quemar_grasa')
    @include('salud_vitalidad')
    @include('accesorios')

@endsection

    