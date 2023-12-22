@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <h1>Mi perfil</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre: </label>
            <span>{{ $user->name }}</span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email: </label>
            <span>{{ $user->email }}</span>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
            Modificar datos
        </button>

        <!-- Modal para modificar el perfil -->
        <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateProfileModalLabel">Modificar datos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Agrega aquí el formulario para modificar el perfil -->
                        <form method="POST" action="{{ route('perfil.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Contraseña actual</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
