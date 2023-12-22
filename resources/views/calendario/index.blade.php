<!-- resources/views/calendario/index.blade.php -->

<!-- Estilos CSS de FullCalendar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<!-- Dependencia de jQuery (requerida por FullCalendar) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success card mx-auto mb-3" style="max-width: 800px;">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="text-center">
        <h1>Calendario</h1>
    </div>

    <div class="card mx-auto mb-3" style="max-width: 800px;">
        <div class="card-body">
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('create') }}" class="btn btn-primary mb-3">Crear Acto</a>
                @endif
            @endauth
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
    var actos = @json($actos);
</script>
@endsection



