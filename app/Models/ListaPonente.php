<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ListaPonente extends Model
{
    protected $table = 'lista_ponentes'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'id_ponente', 'Id_persona', 'Id_acto', 'Orden'
    ];

    public function acto()
    {
        return $this->belongsTo(Acto::class, 'Id_acto');
    }

    // Si tienes un modelo Persona, puedes definir la relación también
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'Id_persona');
    }
}
