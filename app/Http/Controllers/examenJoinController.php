<?php

namespace App\Http\Controllers;

//Componente para los formularios
use Illuminate\Http\Request;

//Componente de validación
use Illuminate\Support\Facades\Validator;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente de fechas / tiempos
use Carbon\Carbon;

//Modelos
use App\Models\User;
use App\Models\Examene;
use App\Models\ExamenesClasico;
use App\Models\ExamenesMultiple;
use App\Models\ExamenesClasicosEntregado;
use App\Models\ExamenesMultiplesEntregado;
use App\Models\ExamenesEntregado;

//Clase principal
class examenJoinController extends Controller{

    //Traer la información del curso
    public function join(Request $request, $id){

        //Validar si el examen es valido
        if(isset($id) && $id!==null){

            // Busca el examen con el ID proporcionado
            $examen = Examene::find($id);

            //Verificar el tipo de examen
            if($examen['tipo'] == 'clasico'){

                // Busca las preguntas con el ID proporcionado
                $preguntas = ExamenesClasico::where('examen_id',$id)->get();

            } else{

                // Busca las preguntas con el ID proporcionado
                $preguntas = ExamenesMultiple::where('examen_id',$id)->get();
            }

            //Retornar la vista con la información
            return view('dashboard.examenes.join',compact('examen','preguntas'));

        } else{ //Examen invalido

            //Mensaje y redirección
            return back()->withErrors(['Examen no disponible.']);
        }
    }

    //Función para validar las respuestas
    public function submit(Request $request, $id){

        //Capturar el valor del examen
        $id_examen = $id;

        //Buscar la info del examen
        $examen = Examene::find($id);

        //Dividir la busqueda segun el caso
        if($examen->tipo=='clasico'){

            //Saber la cantidad de preguntas
            $registros = ExamenesClasico::where('examen_id', $id_examen)->count();

        } else{

            //Saber la cantidad de preguntas
            $registros = ExamenesMultiple::where('examen_id', $id_examen)->count();
        }

        //Validar datos 
        for ($i=1; $i <= $registros; $i++){


        // 1. Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'respuesta-'.$i => 'required', // Concatenación correcta
         ]);


        // 2. Si la validación falla, redirigir con los errores
        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput(); // Devuelve todos los valores anteriores   
            }
        }

        //Marcar como examen entregado
        $examen_entregado = new ExamenesEntregado();
        $examen_entregado->estudiante_id = Auth::User()->id;
        $examen_entregado->examen_id = $id_examen;
        $examen_entregado->calificacion = 0;
        $examen_entregado->fecha_entrega = Carbon::now();
        $examen_entregado->estatus = 'pendiente';
        $examen_entregado->tiempo_entrega = 0;

        //Guardar el usuario en la base de datos
        $examen_entregado->save();

        //Capturar el id
        $id_examen_creado = $examen_entregado->id;

        //Dividir la busqueda segun el caso
        if($examen->tipo=='clasico'){

        //Guardar respuesta del examen 
            for ($i=1; $i <= $registros; $i++){

                //Marcar como examen entregado
                $examen_clasico_entregado = new ExamenesClasicosEntregado();
                $examen_clasico_entregado->examenes_entregado_id =  $id_examen_creado;
                $examen_clasico_entregado->examen_clasico_id  = $request['pregunta-'.$i];
                $examen_clasico_entregado->respuesta = $request['respuesta-'.$i];;

                //Guardar el usuario en la base de datos
                $examen_clasico_entregado->save();
            }

            return redirect()->route('dashboard')->with('success', 'Examen respondido satisfactoriamente.');

        } else{

            //Guardar respuesta del examen 
            for ($i=1; $i <= $registros; $i++){

                //Marcar como examen entregado
                $exame_multiple_entregado = new ExamenesMultiplesEntregado();
                $exame_multiple_entregado->examen_entregado_id =  $id_examen_creado;



                $exame_multiple_entregado->pregunta = $request['pregunta-'.$i];
                $exame_multiple_entregado->respuesta_1 = $request['respuesta-'.$i];
                $exame_multiple_entregado->examenes_multiples_id = $examen->id ;
              
                $exame_multiple_entregado->save();
            }

            return redirect()->route('dashboard')->with('success', 'Examen respondido satisfactoriamente.');


        }

    }
}