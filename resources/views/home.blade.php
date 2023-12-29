@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Menú principal') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="font-size-lg">{{ __('¡Bienvenido a Laravel Artisans!') }}</p>

                    <p class="font-size-lg">{{ __('Somos tu fuente de eventos emocionantes y experiencias inolvidables. En Laravel Artisans, estamos comprometidos a brindarte lo mejor en eventos y actividades para que disfrutes al máximo. Ya sea que estés buscando conferencias inspiradoras, talleres educativos o simplemente momentos de diversión y entretenimiento, estás en el lugar correcto.') }}</p>

                    <p class="font-size-lg">{{ __('Nuestra aplicación está diseñada pensando en ti. Explora nuestra amplia gama de eventos, encuentra tus favoritos y regístrate fácilmente. Mantente al tanto de las últimas actualizaciones y noticias sobre eventos especiales que podrían interesarte.') }}</p>

                    <p class="font-size-lg">{{ __('Únete a nuestra comunidad de amantes de los eventos y descubre nuevas experiencias en cada esquina. Estamos encantados de tenerte a bordo y esperamos que disfrutes al máximo de tu tiempo con Laravel Artisans.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

