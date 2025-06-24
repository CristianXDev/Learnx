<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesClasicosEntregado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examenes_clasicos_entregados';

    protected $fillable = ['examenes_entregado_id','examen_clasico_id','respuesta','estatus'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function examenesClasico()
    {
        return $this->hasOne('App\Models\ExamenesClasico', 'id', 'examen_clasico_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function examenesEntregado()
    {
        return $this->hasOne('App\Models\ExamenesEntregado', 'id', 'examenes_entregado_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesMultiplesEntregados()
    {
        return $this->hasMany('App\Models\ExamenesMultiplesEntregado', 'examen_entregado_id', 'id');
    }
    
}
