<!-- resources/views/calendario/index.blade.php -->

<!-- Estilos CSS de FullCalendar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<!-- Dependencia de jQuery (requerida por FullCalendar) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@extends('layouts.app')
@vite('resources/css/app.css')
@section('content')
@if (session('success'))
    <div class="alert alert-success card mx-auto mb-3" style="max-width: 800px;">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="text-center">
        <h1>Eventos en los que estás inscrito</h1>
    </div>

    <div class="row">
        @foreach($inscripciones as $inscripcion)
            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">{{ $inscripcion->acto->Titulo }}</h5>
                        <p class="card-text">{{ $inscripcion->acto->Fecha }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center">
        <h1>Eventos en los que eres ponente</h1>
    </div>
    <div class="row">
        @foreach($actosComoPonente as $acto)
            <div class="col-md-4 mb-4">
                <div class="card @if ($acto->id_ponente == Auth::id()) bg-warning text-dark @else bg-success text-white @endif">
                    <div class="card-body">
                        <h5 class="card-title">{{ $acto->Titulo }}</h5>
                        <p class="card-text">{{ $acto->Descripcion_corta }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection




