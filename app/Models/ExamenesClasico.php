<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenesClasico extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examenes_clasicos';

    protected $fillable = ['examen_id','pregunta','respuesta'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function examene()
    {
        return $this->hasOne('App\Models\Examene', 'id', 'examen_id');
    }
    
}
