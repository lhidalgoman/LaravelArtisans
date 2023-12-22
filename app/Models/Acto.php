<?php
// app/Models/Acto.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Acto extends Model
{
    protected $table = 'actos'; // Nombre de la tabla en la base de datos
    public $timestamps = false;
    protected $primaryKey = 'Id_acto';
    protected $fillable = [
        'Fecha', 'Hora', 'Titulo', 'Descripcion_corta', 'Descripcion_larga', 'Num_asistentes', 'Id_tipo_acto', 'id_ponente'
    ];

}
