<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

// Esta clase Handler extiende de ExceptionHandler de Laravel y se utiliza
// para manejar todas las excepciones que se lanzan dentro de la aplicación.
// Podemos personalizar su comportamiento según nuestras necesidades.
class Handler extends ExceptionHandler
{
    /**
     * Una lista de tipos de excepción con sus correspondientes niveles de log personalizados.
     * Aquí podemos especificar diferentes niveles de logging para diferentes tipos
     * de excepciones. Es útil para categorizar y filtrar los logs de errores.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        // Aquí irían las excepciones con sus niveles de log, si queremos personalizarlos.
    ];

    /**
     * Una lista de tipos de excepción que no son reportados.
     * Es útil para evitar que ciertas excepciones comunes o menos críticas
     * inunden nuestros logs.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        // Aquí irían las excepciones que queremos excluir de los reportes.
    ];

    /**
     * Una lista de los inputs que nunca se muestran en la sesión en caso de excepciones de validación.
     * Esto es importante por razones de seguridad, para no exponer información sensible como
     * contraseñas en los mensajes de error.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Registrar los callbacks de manejo de excepciones para la aplicación.
     * Aquí podemos definir cómo se manejan diferentes tipos de excepciones
     * en nuestra aplicación. Es un buen lugar para personalizar las respuestas
     * a errores específicos o para implementar lógica adicional, como notificaciones.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Aquí podemos definir acciones específicas para cuando se reporta una excepción,
            // como enviar un email al equipo de soporte, registrar en un sistema externo, etc.
        });
    }
}
