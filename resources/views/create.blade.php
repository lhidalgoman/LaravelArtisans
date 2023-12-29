@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Acto</h1>

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="Fecha" required>
            </div>

            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" class="form-control" id="hora" name="Hora" required>
            </div>

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="Titulo" required>
            </div>

            <div class="form-group">
                <label for="descripcion_corta">Descripción Corta</label>
                <textarea class="form-control" id="descripcion_corta" name="Descripcion_corta" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="descripcion_larga">Descripción Larga</label>
                <textarea class="form-control" id="descripcion_larga" name="Descripcion_larga" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="num_asistentes">Número de Asistentes</label>
                <input type="number" class="form-control" id="num_asistentes" name="Num_asistentes" required>
            </div>

            <div class="form-group">
                <label for="id_tipo_acto">Tipo de Acto</label>
                <select class="form-control" id="id_tipo_acto" name="id_tipo_acto" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_ponente">Ponente</label>
                <select class="form-control" id="id_ponente" name="id_ponente" required>
                @foreach($ponentes as $ponente)
                    <option value="{{ $ponente->id }}">{{ $ponente->name }}</option>
                @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
