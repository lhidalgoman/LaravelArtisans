<!-- resources/views/calendario/index.blade.php -->

<!-- Estilos CSS de FullCalendar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<!-- Dependencia de jQuery (requerida por FullCalendar) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Mostrar los inscritos -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <a href="{{ route('nuevoinscrito') }}" class="btn btn-primary">Nueva inscripción</a>
                </div>

                @if($inscritos->count() > 0)
                    <h2>Inscritos:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Inscripción</th>
                                <th>ID Persona</th>
                                <th>ID Acto</th>
                                <th>Fecha Inscripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inscritos as $inscrito)
                                <tr>
                                    <td>{{ $inscrito->Id_inscripcion }}</td>
                                    <td>{{ $inscrito->Id_persona }}</td>
                                    <td>{{ $inscrito->id_acto }}</td>
                                    <td>{{ $inscrito->Fecha_inscripcion }}</td>
                                    <td>
                                        @auth
                                            @if(auth()->user()->hasRole('admin'))
                                                <!-- Botón Modificar -->
                                                <button type="button" class="btn btn-primary btnModificar" data-toggle="modal" data-target="#modificarModal{{ $inscrito->Id_inscripcion }}">
                                                    Modificar
                                                </button>

                                                <!-- Botón Eliminar -->
                                                <form action="{{ route('inscripciones.destroy', $inscrito->Id_inscripcion) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                                <!-- Modal para modificar inscripción -->
                                                <div class="modal fade" id="modificarModal{{ $inscrito->Id_inscripcion }}" tabindex="-1" role="dialog" aria-labelledby="modificarModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modificarModalLabel">Modificar inscripción</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="{{ route('inscripciones.update', $inscrito->Id_inscripcion) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group">
                                                                        <label for="Id_inscripcion">Inscripción</label>
                                                                        <input type="number" class="form-control" name="Id_inscripcion" id="Id_inscripcion" value="{{$inscrito->Id_inscripcion}}">
                                                                        <label for="Id_persona">Persona</label>
                                                                        <input type="number" class="form-control" name="Id_persona" id="Id_persona" value="{{$inscrito->Id_persona}}">
                                                                        <label for="id_acto">Acto</label>
                                                                        <input type="number" class="form-control" name="id_acto" id="id_acto" value="{{$inscrito->id_acto}}">
                                                                        <label for="Fecha_inscripcion">Fecha</label>
                                                                        <input type="text" class="form-control" id="Fecha" name="Fecha_inscripcion" id="Fecha_inscripcion" value="{{ $inscrito->Fecha_inscripcion }}">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarModal()">Cerrar</button>
                                                                        <button type="submit" class="btn btn-primary" id="btnGuardarCambios">Guardar cambios</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay inscritos.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

<script>
    function cerrarModal() {
        $('modificarModal').modal('hide');
    }



    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(event) {
            var target = event.target;
            if (target.classList.contains('btnModificar')) {
                var dataTarget = target.getAttribute('data-target');
                if (dataTarget) {
                    // Extraer el número del final del valor de data-target
                    var modalNumberMatch = dataTarget.match(/\d+$/);
                    if (modalNumberMatch) {
                        var modalNumber = modalNumberMatch[0];
                        var modal = document.getElementById('modificarModal' + modalNumber);
                        console.log(modalNumber);
                        if (modal) {
                            // Abre el modal utilizando Bootstrap
                            $(modal).modal('show');
                        } else {
                            console.log('No se encontró el modal con el número: ' + modalNumber);
                        }
                    } else {
                        console.log('No se pudo extraer un número del valor de data-target: ' + dataTarget);
                    }
                } else {
                    console.log('El botón no tiene un atributo "data-target"');
                }
            }
        });
    });



</script>
