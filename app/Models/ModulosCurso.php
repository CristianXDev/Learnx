<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulosCurso extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'modulos_cursos';

    protected $fillable = ['titulo','curso_id',];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videosCursos()
    {
       return $this->hasMany('App\Models\VideosCurso', 'modulo_id', 'id'); 
   }

   public function QuizCurso()
    {
       return $this->hasMany('App\Models\QuizCurso', 'modulo_id', 'id'); 
   }


}
