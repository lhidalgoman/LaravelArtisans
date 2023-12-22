<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Documentacion extends Model
{
    protected $table = 'Documentacion'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'Id_presentacion';
    public $timestamps = false;

    protected $fillable = [
        'Id_acto', 'Localizacion_documentacion', 'Orden', 'Id_persona', 'Titulo_documento'
    ];

    // Resto del código de tu modelo
}
