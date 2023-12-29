<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'Documentacion';
    // Clave primaria de la tabla 'Documentacion'
    protected $primaryKey = 'Id_presentacion';
    // Indica que este modelo no usará las columnas created_at y updated_at
    public $timestamps = false;
    // Los campos que se pueden llenar (insertar o actualizar) en la tabla 'Documentacion'
    protected $fillable = [
        'Id_acto', 'Localizacion_documentacion', 'Orden', 'Id_persona', 'Titulo_documento'
    ];
}
