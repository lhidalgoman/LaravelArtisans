<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ListaPonente extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'lista_ponentes';
    // Los campos que se pueden llenar (insertar o actualizar) en la tabla 'lista_ponentes'
    protected $fillable = [
        'id_ponente', 'Id_persona', 'Id_acto', 'Orden'
    ];
    /**
     * Establece una relación de pertenencia con el modelo 'Acto'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acto()
    {
        return $this->belongsTo(Acto::class, 'Id_acto');
    }
    /**
     * Establece una relación de pertenencia con el modelo 'Persona' si está disponible.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|null
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'Id_persona');
    }
}