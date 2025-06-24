<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{

    const Pendiente = 1;
    const Verificado = 2;

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'name',
    'lastName', // Asegúrate de incluir lastName
    'cedula',
    'email',
    'password',
    'estatus', // Asegúrate de incluir estatus
    'rol', // Asegúrate de incluir rol
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

       // En el modelo de usuario
    public function facturas(){

     return $this->hasMany(Factura::class, 'usuario_id', 'id');   
     
    }

     public function inscripcionesCursos(){

       return $this->hasMany(inscripcionesCurso::class, 'estudiante_id', 'id');   
    }

    public function InscripcionesCursoPresencial(){

       return $this->hasMany(InscripcionesCursoPresencial::class, 'estudiante_id', 'id');   
    }

    public function QuizCursoEntregado(){

       return $this->hasMany(QuizCursoEntregado::class, 'estudiante_id', 'id');   
    }



}
