<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionCurso extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'calificacion_curso';

    protected $fillable = ['estudiante_id','curso_id','calificacion'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cursoPresencial()
    {
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
