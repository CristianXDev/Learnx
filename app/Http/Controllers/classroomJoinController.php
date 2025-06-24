<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use Illuminate\Support\Facades\Auth;

class classroomJoinController extends Controller{

    //Join classroom
    public function join($code){

/*
        //Validar el rol del usuario
        if(Auth::user()->rol == 3){

           return redirect()->route('dashboard')->withErrors('No puedes unirte al curso siendo profesor');
       }
*/

        // Busca las preguntas con el ID proporcionado
       $classroom = Classroom::where('codigo_acceso',$code)->first();

       $classroomUser = ClassroomUser::where('classroom_id', $classroom->id)->get();

       if(count($classroomUser) >= $classroom->max_estudiantes){

        return redirect()->route('classroom_public')->withErrors('Ya te uniste a esta aula');

       }


       if($classroom){

        //Valida si ya estoy unido al aula
          $classroomUser = ClassroomUser::where('usuario_id',  Auth::user()->id)
            ->where('classroom_id', $classroom->id)
            ->first();


        if($classroomUser){

            return redirect()->route('dashboard')->withErrors('Ya te uniste a esta aula');

        } else{

              return view('dashboard.classroom.join',compact('classroom'));
        }      

     } else{

        return redirect()->route('dashboard')->withErrors('El código de acceso al aula es invalida');
    }
}


    public function accept($code)
    {
        // Validar el rol del usuario
        if (Auth::user()->rol == 3) {
            return redirect()->route('dashboard')->withErrors('No puedes unirte al curso siendo profesor');
        }

        // Busca las preguntas con el ID proporcionado
        $classroom = Classroom::where('codigo_acceso', $code)->first();

        if ($classroom) {
            // Guardar datos de la inscripción
            $classroomUser = new ClassroomUser();
            $classroomUser->usuario_id = Auth::user()->id;
            $classroomUser->classroom_id = $classroom->id;
            $classroomUser->save(); // No olvides guardar la instancia

         return redirect('/dashboard/classrooms/home/'.$code)->with('success', 'Has sido agregado a esta aula');

        } else {
            return redirect()->route('dashboard')->withErrors('El código de acceso al aula es inválido');
        }
    }
}
