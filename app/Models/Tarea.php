<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tareas';

    protected $fillable = ['nombre','descripcion','documento','classroom_id','fecha_entrega'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classroom()
    {
        return $this->hasOne('App\Models\Classroom', 'id', 'classroom_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tareasEntregadas()
    {
        return $this->hasMany('App\Models\TareasEntregada', 'tarea_id', 'id');
    }
    
}
