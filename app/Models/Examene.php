<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examene extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'examenes';

    protected $fillable = ['nombre','descripcion','tipo','fecha_inicio','fecha_fin','lim_tiempo','estatus','materia_id','submateria_id','classroom_id','profesor_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'profesor_id');
    }
    
    public function classroom()
    {
        return $this->hasOne('App\Models\Classroom', 'id', 'classroom_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesClasicos()
    {
        return $this->hasMany('App\Models\ExamenesClasico', 'examen_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesEntregados()
    {
        return $this->hasMany('App\Models\ExamenesEntregado', 'examen_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesMultiples()
    {
        return $this->hasMany('App\Models\ExamenesMultiple', 'examen_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function materia()
    {
        return $this->hasOne('App\Models\Materia', 'id', 'materia_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function submateria()
    {
        return $this->hasOne('App\Models\Submateria', 'id', 'submateria_id');
    }
    
}
