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
<!-- ... (código de la vista) ... -->

<div class="container">
    <div class="text-center">
        <h1>Documentación de Eventos Pasados</h1>
    </div>

    @foreach($actosPasados as $acto)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $acto->Titulo }}</h5>
                <p class="card-text">Fecha: {{ $acto->Fecha }}</p>

                <!-- Formulario para subir documentos -->
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('ponente'))
                    <form action="{{ route('subir_documento') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_acto" value="{{ $acto->Id_acto }}">
                        <label for="localizacion">Localización del Documento:</label>
                        <select name="localizacion" id="localizacion" class="form-control">
                            <option value="Sala A">Sala A</option>
                            <option value="Sala B">Sala B</option>
                            <option value="Sala C">Sala C</option>
                        </select>
                        <input type="file" name="documento" required>
                        <label for="orden">Orden:</label>
                        <input type="text" name="orden" required>
                        <input type="submit" value="Subir Documento">
                    </form>
                @endif
                <!-- Mostrar documentos asociados a este acto -->
                <h6>Documentos:</h6>
                @foreach($acto->documentacion as $documento)
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">{{ $documento->Titulo_documento }}</h6>
                            <p class="card-text">Orden: {{ $documento->Orden }}</p>
                            <a href="{{ Storage::url('documentos/' . $documento->Titulo_documento) }}" target="_blank">Ver Documento</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@endsection



