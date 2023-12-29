<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// La clase Kernel extiende de ConsoleKernel de Laravel, y es utilizada
// para definir ciertas configuraciones y comportamientos de la consola
// y programación de tareas.
class Kernel extends ConsoleKernel
{
    /**
     * Define la programación de comandos de la aplicación.
     *
     * Aquí puedes definir todas las tareas programadas de Laravel.
     * Laravel proporciona una forma concisa y expresiva de definir
     * la programación de comandos utilizando el objeto Schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejemplo de cómo programar un comando:
        // $schedule->command('inspire')->hourly();
        // Esto ejecutaría el comando 'inspire' cada hora.
    }

    /**
     * Registra los comandos para la aplicación.
     *
     * Este método carga automáticamente todos los comandos de la carpeta
     * 'Commands' y también los comandos definidos en el archivo 'console.php'.
     *
     * @return void
     */
    protected function commands()
    {
        // Carga los comandos ubicados en el directorio 'Commands'.
        $this->load(__DIR__.'/Commands');

        // Requiere el archivo de rutas de consola, que es donde puedes definir
        // todos los comandos de Artisan basados en Closures.
        require base_path('routes/console.php');
    }
}
