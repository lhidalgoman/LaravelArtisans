<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//Modelo clase acto para interpretar los actos de la app
class Acto extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'actos';
    // Indica que este modelo no usará las columnas created_at y updated_at
    public $timestamps = false;
    // La clave primaria de la tabla 'actos' en la base de datos
    protected $primaryKey = 'Id_acto';
    // Los campos que se pueden llenar (insertar o actualizar) en la tabla 'actos'
    protected $fillable = [
        'Fecha', 'Hora', 'Titulo', 'Descripcion_corta', 'Descripcion_larga', 'Num_asistentes', 'id_tipo_acto', 'id_ponente'
    ];

    // Establece una relación uno a muchos con el modelo 'Documentacion'
    // Esto significa que un acto puede tener múltiples documentos asociados
    public function documentacion()
    {
        // La función hasMany define la relación y especifica la clave foránea ('Id_acto') y la clave local ('Id_acto')
        return $this->hasMany(Documentacion::class, 'Id_acto', 'Id_acto');
    }
}