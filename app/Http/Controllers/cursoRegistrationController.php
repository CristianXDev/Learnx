<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscripcionesCurso;
use App\Models\InscripcionesCursoPresencial;

class cursoRegistrationController extends Controller{


    public function registration($id){

        //Guardar datos de la inscripción
        $inscripcion = new InscripcionesCurso();
        $inscripcion->estudiante_id = Auth()->user()->id; 
        $inscripcion->curso_id = $id;

        //Guardar los datos en la base de datos
        $inscripcion->save();

        return redirect('/dashboard/cursos/view/'.$id)->with('success','Has sido asignado a este curso');
    }

    public function registrationPresencial($id){

        //Guardar datos de la inscripción
        $inscripcion = new InscripcionesCursoPresencial();
        $inscripcion->estudiante_id = Auth()->user()->id; 
        $inscripcion->curso_id = $id;

        //Guardar los datos en la base de datos
        $inscripcion->save();

        return redirect('/dashboard/curso/presencial/view/'.$id)->with('success','Has sido asignado a este curso');
    }


}
