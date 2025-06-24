<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Curso;
use App\Models\Classroom;

use Carbon\Carbon;

class EstadisticaController extends Controller{

    public function usuarios(){

        //Usuarios por rol
        $admins =  User::where('rol',1)->get(); //Usuarios administradores
        $profesores =  User::where('rol',2)->get(); //Usuarios profesores
        $estudiantes =  User::where('rol',3)->get(); //Usuarios estudiantes

        //Usuarios por rol y fecha
        $profesores_mes = User::where('rol', 2)
          ->whereMonth('created_at', Carbon::now()->month) // Filtrar por mes actual
          ->get(); 

        $estudiantes_mes = User::where('rol', 3)
          ->whereMonth('created_at', Carbon::now()->month) // Filtrar por mes actual
          ->get();

        return view('dashboard.estadisticas.usuarios',
        compact(
            'admins',
            'estudiantes',
            'profesores',
            'profesores_mes',
            'estudiantes_mes'
         ));
    }

    public function cursos(){

        //Tipos de cursos

        $cursos_gratis =  Curso::where('tipo','gratis')->get(); //Cursos publicos
        $cursos_premium =  Curso::where('tipo','premium')->get(); //Cursos privados

        //Cursos por mes
        $cursos = User::where('created_at', Carbon::now()->month) // Filtrar por mes actual
        ->get();

        return view('dashboard.estadisticas.cursos',
            compact(
                'cursos_premium',
                'cursos_gratis',
                'cursos'
            ));
    }

    public function classrooms(){

        //Tipos de cursos

        $classroom_publico =  Classroom::where('tipo','publico')->get(); //Cursos publicos
        $classroom_privado =  Classroom::where('tipo','privadi')->get(); //Cursos privados

        //Cursos por mes
        #$cursos = User::where('created_at', Carbon::now()->month) // Filtrar por mes actual
        #->get();

        return view('dashboard.estadisticas.classroom',
            compact(
                'classroom_publico',
                'classroom_privado'
            ));
    }

}
