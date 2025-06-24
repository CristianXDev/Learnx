<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCurso extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'quiz_curso';

    protected $fillable = ['pregunta','respuesta_1','respuesta_2','respuesta_3','respuesta_4','modulo_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function modulosCurso()
    {
        return $this->hasOne('App\Models\ModulosCurso', 'id', 'modulo_id');
    }
    
}
