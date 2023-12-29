<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model{
    // Nombre de la tabla en la base de datos
    protected $table = 'Inscritos';
    // Clave primaria de la tabla 'Inscritos'
    protected $primaryKey = 'Id_inscripcion';
    // Indica que este modelo no usará las columnas created_at y updated_at
    public $timestamps = false;
    // Los campos que se pueden llenar (insertar o actualizar) en la tabla 'Inscritos'
    protected $fillable = [
        'Id_persona', 'id_acto', 'Fecha_inscripcion'
    ];
    /**
     * Establece una relación de pertenencia con el modelo 'Acto'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acto()
    {
        return $this->belongsTo(Acto::class, 'id_acto');
    }
}