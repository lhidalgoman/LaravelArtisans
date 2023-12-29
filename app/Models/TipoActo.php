<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoActo extends Model
{
    protected $table = 'Tipo_acto'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'Id_tipo_acto';
    public $timestamps = false;

    protected $fillable = [
        'Descripcion'
    ];
}
