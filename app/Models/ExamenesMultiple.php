<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesMultiple extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examenes_multiples';

    protected $fillable = ['examen_id','pregunta','respuesta_1','respuesta_2','respuesta_3','respuesta_4'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function examene()
    {
        return $this->hasOne('App\Models\Examene', 'id', 'examen_id');
    }
    
}
