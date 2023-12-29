<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'Tipos_usuarios'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'Id_tipo_usuario';
    public $timestamps = false;

    protected $fillable = [
        'Descripcion'
    ];
}
