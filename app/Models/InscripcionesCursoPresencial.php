<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscripcionesCursoPresencial extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'inscripciones_curso_presencial';

    protected $fillable = ['estudiante_id','curso_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function cursoPresencial(){

        return $this->hasOne('App\Models\CursoPresencial', 'id', 'curso_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'estudiante_id');
    }
    
}
