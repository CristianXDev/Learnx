<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCursoEntregado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'quiz_curso_entregado';

    protected $fillable = ['estudiante_id','modulo_id','fecha_entrega','estatus'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function modulosCurso()
    {
        return $this->hasOne('App\Models\ModulosCurso', 'id', 'modulo_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'estudiante_id');
    }
    
}
