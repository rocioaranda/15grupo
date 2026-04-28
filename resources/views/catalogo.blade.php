<!-- 🛍️ CATÁLOGO -->

@extends('layouts.app')
<h2 class="text-center mb-5 text-success fw-bold">Nuestro Catálogo</h2>
@section('main')

@include('secciones.aumento_masa')
@include('secciones.quemar_grasa')
@include('secciones.salud_vitalidad')
@include('secciones.accesorios')

@endsection


    