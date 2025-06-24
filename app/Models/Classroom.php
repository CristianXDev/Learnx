<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'classrooms';

    protected $fillable = ['foto','nombre','descripcion','profesor_id','materia_id','codigo_acceso','estatus','tipo','max_estudiantes'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatsClassrooms()
    {
        return $this->hasMany('App\Models\ChatsClassroom', 'classroom_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classroomUsers()
    {
        return $this->hasMany('App\Models\ClassroomUser', 'classroom_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenes()
    {
        return $this->hasMany('App\Models\Examene', 'classroom_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function materia()
    {
        return $this->hasOne('App\Models\Materia', 'id', 'materia_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tareas()
    {
        return $this->hasMany('App\Models\Tarea', 'classroom_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'profesor_id');
    }
    
}
