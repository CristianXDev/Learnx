<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classroom;
use App\Models\Curso;

class homeController extends Controller{

    public function home(){

        $classroom = Classroom::take(3)->get();

        return view('home.index',compact('classroom'));
    }

    public function classroom(){

        $classroom = Classroom::all();

        return view('home.classroom',compact('classroom'));
    }

    public function curso(){

        $curso = Curso::all();

        return view('home.curso',compact('curso'));
    }


}
