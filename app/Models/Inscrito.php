<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inscrito extends Model
{
    protected $table = 'Inscritos'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'Id_inscripcion';
    public $timestamps = false;

    protected $fillable = [
        'Id_persona', 'id_acto', 'Fecha_inscripcion'
    ];

    public function acto()
    {
        return $this->belongsTo(Acto::class, 'id_acto');
    }
    // Resto del código de tu modelo
}
