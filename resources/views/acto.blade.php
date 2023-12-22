<!-- resources/views/calendario/index.blade.php -->
<!-- Estilos CSS de FullCalendar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<!-- Dependencia de jQuery (requerida por FullCalendar) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-danger" style="font-size: 24px;">Detalles del Acto</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text">Título: {{ $acto->Titulo }}</p>
                <p class="card-text">Fecha: {{ $acto->Fecha }}</p>
                <p class="card-text">Hora: {{ $acto->Hora }}</p>
                <p class="card-text">Descripcion Corta: {{ $acto->Descripcion_corta }}</p>
                <p class="card-text">Descripcion Larga: {{ $acto->Descripcion_larga }}</p>
                <p class="card-text">Número de asistentes: {{ $acto->Num_asistentes }}</p>
                <p class="card-text">Tipo de Acto: {{ $acto->Id_tipo_acto }}</p>
                <p class="card-text">Id Ponente: {{ $acto->id_ponente }}</p>


                @auth
                    @if(auth()->user()->hasRole('admin'))
                    <!-- Botón Modificar -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modificarModal" id="btnModificar">
                        Modificar
                    </button>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('actos.destroy', $acto->Id_acto) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <!-- Modal Modificar -->
    <div class="modal fade" id="modificarModal" tabindex="-1" role="dialog" aria-labelledby="modificarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificarModalLabel">Modificar Acto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí coloca los campos del formulario para modificar el acto -->
                    <form action="{{ route('actos.update', $acto->Id_acto) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Campos del formulario -->
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="Titulo" value="{{ $acto->Titulo }}">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="Fecha" name="Fecha" value="{{ $acto->Fecha }}">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control" id="Hora" name="Hora" value="{{ $acto->Hora }}">
                            <label for="descripcion_corta">Descripción Corta</label>
                            <input type="text" class="form-control" id="Descripcion_corta" name="Descripcion_corta" value="{{ $acto->Descripcion_corta }}">
                            <label for="descripcion_larga">Descripción Larga</label>
                            <input type="text" class="form-control" id="Descripcion_larga" name="Descripcion_larga" value="{{ $acto->Descripcion_larga }}">
                            <label for="num_asistentes">Número de asistentes</label>
                            <input type="number" class="form-control" id="Num_asistentes" name="Num_asistentes" value="{{ $acto->Num_asistentes }}">
                            <label for="acto">Acto</label>
                            <input type="number" class="form-control" id="id_tipo_acto" name="id_tipo_acto" value="{{ $acto->Id_tipo_acto }}">
                            <label for="ponente">Ponente</label>
                            <input type="number" class="form-control" id="id_ponente" name="id_ponente" value="{{ $acto->id_ponente }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModal()" >Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // Espera a que el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Escucha el evento click del botón "Modificar"
        document.getElementById('btnModificar').addEventListener('click', function() {
            // Abre el modal
            $('#modificarModal').modal('show');
        });
    });

    function cerrarModal() {
        $('#modificarModal').modal('hide');
    }
</script>
