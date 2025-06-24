<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesEntregado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examenes_entregados';

    protected $fillable = ['estudiante_id','examen_id','calificacion','fecha_entrega','tiempo_entrega','estatus'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function examene()
    {
        return $this->hasOne('App\Models\Examene', 'id', 'examen_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesClasicosEntregados()
    {
        return $this->hasMany('App\Models\ExamenesClasicosEntregado', 'examenes_entregado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'estudiante_id');
    }
    
}
