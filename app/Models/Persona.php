<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'Personas'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'Id_persona';
    public $timestamps = false;

    protected $fillable = [
        'Nombre', 'Apellido1', 'Apellido2'
    ];
}
