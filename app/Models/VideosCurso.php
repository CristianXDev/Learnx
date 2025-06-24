<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosCurso extends Model{

	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'videos_cursos';

    protected $fillable = ['titulo','descripcion','vistas','like','dislike','video','modulo_id'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    
    public function curso(){

        return $this->hasOne('App\Models\Curso', 'id', 'curso_id');
    }
    
    public function modulosCurso(){

     return $this->belongsTo('App\Models\ModulosCurso', 'modulo_id', 'id');
    }

    public function likes(){

        return $this->hasMany(Like::class, 'video_id');
    }
}
