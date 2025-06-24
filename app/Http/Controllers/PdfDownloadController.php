<?php

namespace App\Http\Controllers;

//Componentes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Str;
use Carbon\Carbon;

//Modelos
use App\Models\Examene;
use App\Models\ExamenesClasicosEntregado;
use App\Models\Curso;
use App\Models\Factura;

//Qr
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;


class PdfDownloadController extends Controller{

    public function certificado(Request $request){

        //Datos usuario
        $nombre = Auth::user()->name;
        $apellido = Auth::user()->lastName;

        //Datos curso
        $curso = Curso::findOrFail($request->curso_id);
        $nombreCurso = $curso->nombre;

        //Fecha
        $fecha = Carbon::now()->format('d-m-Y');

        //Generar QR
        $renderer = new GDLibRenderer(400);

        $writer = new Writer($renderer);

        $writer->writeFile('Hello World!', 'static/assets/img/Qr/certificado-qr.png');

        $qr = '/static/assets/img/Qr/certificado-qr.png';

        return \PDF::loadView('dashboard.pdf.certificado',
         compact('nombre','apellido', 'nombreCurso', 'fecha','curso','qr'))
        ->setPaper('a4', 'landscape')
        ->download('certificado.pdf');
    }

    public function factura(Request $request){

        //Datos usuario
        $nombre = Auth::user()->name;
        $apellido = Auth::user()->lastName;
        $email = Auth::user()->email;
        $cedula = Auth::user()->cedula;

        //Datos curso
        $factura = Factura::findOrFail($request->factura_id);

        //Fecha
        $fecha = $factura->fecha_pago;
        $fechaFormateada = Carbon::parse($fecha)->format('d-m-Y');

        //Descripción
        $descripcion = Str::limit($factura->curso->descripcion, 50, '...');

        //Referencia
        $referencia = $factura->referencia; 

        //Generar QR
        $renderer = new GDLibRenderer(400);

        $writer = new Writer($renderer);

        $writer->writeFile('Hello World!', 'static/assets/img/Qr/factura-qr.png');

        $qr = '/static/assets/img/Qr/factura-qr.png';

        return \PDF::loadView('dashboard.pdf.factura',compact('nombre','apellido','cedula','email','factura','fechaFormateada','descripcion','qr'))
        ->setPaper('a4', 'landscape')
        ->download('factura.pdf');
    }

    public function retroalimentacion($id){

    //Conseguir registro de preguntas y respuestas
    $examen = ExamenesClasicosEntregado::where('examenes_entregado_id',$id)->get();

    //Establacer array
    $preguntasRespuestas = [];

    //Guardar preguntas y respuestas en mi array 
    foreach ($examen as $row) {
        $preguntasRespuestas[] = [
            'pregunta' => $row->examenesClasico->pregunta,
            'respuesta' => $row->respuesta,
            'estatus' => $row->estatus,
        ];


       $prompt =  implode("\n\n\n", array_map(function($preguntaRespuesta) {
            return "Pregunta: " . $preguntaRespuesta['pregunta'] . "\nRespuesta: " . $preguntaRespuesta['respuesta'] . "\nEstatus de la pregunta: " .$preguntaRespuesta['estatus'];
        }, $preguntasRespuestas));

    //Gemini
    $result = Gemini::geminiPro()->generateContent(
        "Necesito recomendaciones del examen de este estudiante, siguiento estrictamente esta estructura html (Utilizando solamente del listado de preguntas y respuestas te las doy al final):

        <hr>

        <h3>Pregunta:</h3> <p> (Impimir la pregunta aquí) </p> <br>
        <h3>Respuesta:</h3> (Impimir la respuesta aquí) (Correcta o Incorrecta): <p> (Impimir la estatus aquí) 

        si es correcto

        <span class='check'> Correcto</span>
        <img src='{{public_path().'/static/assets/img/others/check.png'}}' alt='' width='30' height='30' class='mt-1'>

        si es incorrecto

        <span class='x'> Incorrecto</span>
        <img src='{{public_path().'/static/assets/img/others/x.png'}}' alt='' width='30' height='30' class='mt-1'>

        </p> <br>

        <h3>Recomendaciones:</h3> <p> (Impimir la recomendaciones aquí) </p><br>

        <h3>Ejerciciós de practica:</h3> <p> (Impimir la pregunta aquí) </p><br>

        <hr>

        Y así con todas las preguntas (Si las hay) siguiendo esa estructura. Aquí las preguntas y respuestas dadas por el estudiantes en su examen:". $prompt);

    $text = $result->text();

    $secciones = explode("\n\n", $text);

    foreach ($secciones as &$seccion) {
     $seccion = trim($seccion);
     $seccion = str_replace("\n", " ", $seccion); 
     $seccion = str_replace("`", " ", $seccion);
     $seccion = str_replace("*", " ", $seccion);
     $seccion = str_replace("#", " ", $seccion);

     }

     return \PDF::loadView('dashboard.pdf.retroalimentacion', compact('secciones'))
     ->setPaper('a4', 'landscape')
     ->download('retroalimentacion.pdf');

      }

    }

    public function examen($id){

        //ID del estudiante actual
        $estudiante = Auth::user()->name.' '.Auth::user()->lastName;

        //ID del examen
        $exam = Examene::find($id);

        //Conseguir registro de preguntas y respuestas
        $examen = ExamenesClasicosEntregado::where('examenes_entregado_id',$id)->get();

        //Establacer array
        $preguntasRespuestas = [];

        //Guardar preguntas y respuestas en mi array 
        foreach ($examen as $row) {
            $preguntasRespuestas[] = [
                'pregunta' => $row->examenesClasico->pregunta,
                'respuesta' => $row->respuesta,
                'estatus' => $row->estatus,
            ];
        }

        return \PDF::loadView('dashboard.pdf.examen', compact('preguntasRespuestas', 'estudiante', 'exam'))
        ->setPaper('a4', 'landscape')
        ->download('examen.pdf');
   
    }
}
