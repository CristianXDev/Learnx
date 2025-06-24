<?php

namespace App\Http\Controllers;

//Componente para los formularios
use Illuminate\Http\Request;

//Componente de validación
use Illuminate\Support\Facades\Validator;

//Modelo
use App\Models\ModulosCurso;
use App\Models\QuizCurso;
use App\Models\QuizCursoEntregado;

//Clase principal
class QuizCursoController extends Controller{

    //Traer la información del curso
    public function join(Request $request, $id){

        //Busca las preguntas con el ID proporcionado
        $modulo = ModulosCurso::find($id);
        $curso = $modulo->curso;

        //Listado de preguntas
        $preguntas = QuizCurso::where('modulo_id',$id)->get();

        //Retornar la vista con la información
        return view('dashboard.quiz-curso.join', compact('preguntas','modulo','curso'));
    }

    public function submit(Request $request, $id){

        $preguntas = QuizCurso::where('modulo_id', $id)->get();

        // 1. Validar que todas las preguntas fueron respondidas
        $rules = [];
        foreach ($preguntas as $pregunta) {
            $rules['respuesta-'.$pregunta->id] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        // 2. Calcular respuestas correctas
        $respuestasCorrectas = 0;
        foreach ($preguntas as $pregunta) {
            $respuestaUsuario = $request->input('respuesta-'.$pregunta->id);
            if ($respuestaUsuario === $pregunta->respuesta_1) {
                $respuestasCorrectas++;
            }
        }

        // 3. Determinar si aprueba (más de la mitad correctas)
        $totalPreguntas = $preguntas->count();
        $aprobado = $respuestasCorrectas > ($totalPreguntas / 2);

        // 4. Guardar resultado en QuizCursoEntregado
        QuizCursoEntregado::create([
            'estudiante_id' => auth()->id(),
            'modulo_id' => $id,
            'fecha_entrega' => now()->toDateString(),
            'estatus' => $aprobado ? 'aprobado' : 'rechazado'
        ]);

        if ($aprobado){
        // Redirección con mensaje de éxito
            return redirect()->route('cursos-public')
            ->with('success', 'Se ha desbloqueado el siguiente módulo!');

        } else{
        // Redirección con mensaje de error
            return redirect()->route('cursos-public')
            ->withErrors('Has fallado el quiz, intente más tarde.');
        }
    }
}


