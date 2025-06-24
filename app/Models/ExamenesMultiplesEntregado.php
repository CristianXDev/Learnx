<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesMultiplesEntregado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examenes_multiples_entregados';

    protected $fillable = ['examen_entregado_id','examenes_multiples_id','pregunta','respuesta_1','estatus'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function examenesMultiplesEntregado()
    {
        return $this->hasOne('App\Models\ExamenesMultiplesEntregado', 'id', 'examen_entregado_id');
    }
    
}
