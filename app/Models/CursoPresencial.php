<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoPresencial extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'curso_presencial';

    protected $fillable = ['nombre','descripcion','image','estatus','calificacion','profesor_id','categoria_id','aula_id','fecha_ini','estudiantes_max','fecha_fin'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'profesor_id');
    }
    
}
