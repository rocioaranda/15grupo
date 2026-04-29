<!-- 🛍️ CATÁLOGO -->

@extends('layouts.app')
@section('main')

<div class="text-center">
    <h2 class="titulo-catalogo text-success fw-bold text-uppercase">
        Nuestro Catálogo
    </h2>
</div>

@include('secciones.aumento_masa')
@include('secciones.quemar_grasa')
@include('secciones.salud_vitalidad')
@include('secciones.accesorios')

@endsection


    