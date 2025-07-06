<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use App\Models\InscripcionesCurso;
use App\Models\InscripcionesCursoPresencial;

class ApiController extends Controller{

    public function index(){

        $cursos_online = InscripcionesCurso::all();
        $curso_presencial = InscripcionesCursoPresencial::all();

        return view('dashboard.api.index',compact('cursos_online','curso_presencial'));
    }

    public function rest(){

        $cursos_online = InscripcionesCurso::all();
        $curso_presencial = InscripcionesCursoPresencial::all();

        return response()->json([
            'cursos_online' => $cursos_online,
            'cursos_presenciales' => $curso_presencial
        ]);
    }

}
