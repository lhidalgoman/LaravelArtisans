<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

//Clase para encritar las cookies
class EncryptCookies extends Middleware
{
    /**
     * Los nombres de las cookies que no deben ser encriptadas.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
