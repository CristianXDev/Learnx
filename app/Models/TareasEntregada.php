<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareasEntregada extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tareas_entregadas';

    protected $fillable = ['estudiante_id','tarea_id','documento','fecha_entrega','calificacion'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tarea()
    {
        return $this->hasOne('App\Models\Tarea', 'id', 'tarea_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'estudiante_id');
    }
    
}
