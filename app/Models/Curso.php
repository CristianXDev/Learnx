<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cursos';

    protected $fillable = ['nombre','descripcion','image','tipo','precio','estatus','calificacion','profesor_id','categoria_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentariosCursos()
    {
        return $this->hasMany('App\Models\ComentariosCurso', 'curso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany('App\Models\Factura', 'curso_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'profesor_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function modulosCursos()
    {
        return $this->hasMany(ModulosCurso::class, 'curso_id');
    } 

    public function calificacionCurso(){

    return $this->hasMany(CalificacionCurso::class, 'curso_id');
    }

}
