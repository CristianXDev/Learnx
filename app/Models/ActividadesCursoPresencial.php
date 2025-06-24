<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesCursoPresencial extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'actividades_curso_presencial';

    protected $fillable = ['nombre','curso_presencial_id','aula_id','fecha_ini','fecha_fin'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aula()
    {
        return $this->hasOne('App\Models\Aula', 'id', 'aula_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cursoPresencial()
    {
        return $this->hasOne('App\Models\CursoPresencial', 'id', 'curso_presencial_id');
    }
    
}
