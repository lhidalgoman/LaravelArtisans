<!-- resources/views/calendario/index.blade.php -->

<!-- Estilos CSS de FullCalendar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<!-- Dependencia de jQuery (requerida por FullCalendar) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- resources/views/nuevo.blade.php -->

<!-- resources/views/nuevo.blade.php -->

@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('inscripciones.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="persona">Seleccionar persona:</label>
                    <select name="Id_persona" id="Id_persona" class="form-control">
                        @foreach($personas as $persona)
                            <option value="{{ $persona->Id_persona }}">{{ $persona->Nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="acto">Seleccionar acto:</label>
                    <select name="id_acto" id="id_acto" class="form-control">
                        @foreach($actos as $acto)
                            <option value="{{ $acto->Id_acto}}">{{ $acto->Titulo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha y hora actual:</label>
                    <input type="text" name="Fecha_inscripcion" id="Fecha_inscripcion" class="form-control" value="{{ now() }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Crear inscripción</button>
            </form>
        </div>
    </div>
</div>
@endsection
