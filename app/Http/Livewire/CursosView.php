<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\Curso;
use App\Models\VideosCurso;
use App\Models\ModuloCurso;
use App\Models\QuizCurso;
use App\Models\VideosCompletado;
use App\Models\ComentariosCurso;
use App\Models\Like;
use App\Models\CalificacionCurso;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente para solicitudes complejas a la base de datos
use Illuminate\Support\Facades\DB;

//Clase principal
class CursosView extends Component{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    //Variables del curso
    public $id_curso, $curso, $inscrito, $executed = false;

    //Variables de los videos
    public  $videoId, $videoIdSave, $video_src, $titulo, $descripcion, $completado = false, $porcentaje;

    //Variables de los comentarios
    public $comentario, $comentario_update, $comentarioActive = false;

    //Variables like /dislike
    public $like, $likeValidate, $dislike, $dislikeValidate, $likesTotal, $dislikesTotal;

    //Variables de la calificación
    public $calificado, $estrellas = [], $porcentajesEstrellas = [], $totalCalificaciones = 0, $promedioCalificacion = 0;

    //Render
    public function render(){

        //Esta condicional sólo se ejecuta una vez
        if(!$this->executed){

            //Cargar información de los videos
            $this->toggleVideo($this->videoId);

            //Marcamos como ejecutado está función
            $this->executed = true; 
        }

        //Cargar porcentaje de videos vistos
        $this->progressBar();
        $this->init();

        return view('livewire.cursos-view.view',[

            //Comentarios sobre el curso
            'comentarios' => ComentariosCurso::latest()->paginate(5),
        ]);
    }

    /*=====================     
             GENERAL
     =====================*/

    //Buscamos datos adicionales 
    public function mount($id){

        //Buscamos la información del curso
        $this->curso = Curso::find($id);

        if(!$this->curso == null){

        //Guardar la información del primer video
        $this->videoId = $this->curso->modulosCursos->first()->videosCursos->first()->id;

        //Verificamos si el usuario actual está inscrito en el curso
        $this->inscrito = auth()->user()->inscripcionesCursos()->where('curso_id', $id)->exists();
        
        }
    }

    //Inicializar valores
    public function init(){

        //Validar si el video que se carga está completado
        $this->completado = VideosCompletado::where('estudiante_id', auth()->id())
        ->where('videos_id', $this->videoIdSave)
        ->exists();

        //Validar si el video tiene like
        $this->likeValidate = Like::where('estudiante_id', auth()->id())
        ->where('video_id', $this->videoIdSave)
        ->where('like', 1)
        ->exists();

        //Validar si el video tiene dislike
        $this->dislikeValidate = Like::where('estudiante_id', auth()->id())
        ->where('video_id', $this->videoIdSave)
        ->where('dislike', 1)
        ->exists();

        $this->likesTotal = Like::where('estudiante_id', auth()->id())
        ->where('video_id', $this->videoIdSave)
        ->where('like', 1)
        ->count();

        $this->dislikesTotal = Like::where('estudiante_id', auth()->id())
        ->where('video_id', $this->videoIdSave)
        ->where('dislike', 1)
        ->count();

        if(!$this->curso == null ){

        $this->calificado = CalificacionCurso::where('estudiante_id', auth()->id())
        ->where('curso_id', $this->curso->id)
        ->exists();


        // Reiniciamos los valores acumuladores
        $this->totalCalificaciones = 0;
        $this->promedioCalificacion = 0;

        //Sacamos el conteo de todas las calificaciones
        for ($calificacion = 1; $calificacion <= 5; $calificacion++){

            $count = CalificacionCurso::where('curso_id', $this->curso->id)
            ->where('calificacion', $calificacion)
            ->count();

            $this->estrellas[$calificacion] = $count;
            $this->totalCalificaciones += $count;
            $this->promedioCalificacion += ($calificacion * $count);
        }        

         // Luego, calculamos los porcentajes
        if ($this->totalCalificaciones > 0) { // Evitar división por cero
            for ($calificacion = 1; $calificacion <= 5; $calificacion++) {

                $porcentaje = ($this->estrellas[$calificacion] / $this->totalCalificaciones) * 100;
                $this->porcentajesEstrellas[$calificacion] = round($porcentaje, 2); // Redondear a 2 decimales
            }

            $this->promedioCalificacion = round($this->promedioCalificacion / $this->totalCalificaciones, 2); 
        } else {

             for ($calificacion = 1; $calificacion <= 5; $calificacion++) {
                $this->porcentajesEstrellas[$calificacion] = 0;
            }

            $this->promedioCalificacion = 0;
        }


        }
    }


    /*=====================
             VIDEO
     =====================*/

    //Cambiar videos
    public function toggleVideo($id){

        if(!$this->curso == null ){

            //Capturamos el id del video a cargar
            $video_id = $id;

            //Buscar información del video por su id
            $video = VideosCurso::find($video_id);

            //Guardar valores a mostrar en loa vista
            $this->video_src = $video->video;
            $this->titulo = $video->titulo;
            $this->descripcion = $video->descripcion;
            $this->videoIdSave = $video->id;

            $this->dispatchBrowserEvent('video-updated');
        }
    }

    //Cambiar el estatus del switch (Boton de progreso)
    public function toggleCompleto(){

        //Validamos si ya el usuario completó el video
        if($this->completado){

            // Guardar registro si el switch se activa
            VideosCompletado::create([
                'estudiante_id' => auth()->id(),
                'videos_id' => $this-> videoIdSave,
            ]);

            session()->flash('message', 'Tu progreso ha sido actualizado.');

        } else {

            // Borrar el registro si el switch se desactiva
            VideosCompletado::where('estudiante_id', auth()->id())
            ->where('videos_id', $this-> videoIdSave)
            ->delete();

            session()->flash('alert', 'Tu progreso ha sido eliminado.');
        }        
    }

    /*=====================
       BARRA DE PROGRESO
     =====================*/

    public function progressBar(){

       if(!$this->curso == null ){

       // Videos totales del curso
        $videosTotales =  DB::table('modulos_cursos')
        ->join('videos_cursos', 'modulos_cursos.id', '=', 'videos_cursos.modulo_id') // Une las tablas
        ->where('modulos_cursos.curso_id', $this->curso->id) // Filtra por curso
        ->count();

        // Obtener los IDs de videos del curso
        $videosIdsCurso = DB::table('modulos_cursos')
        ->join('videos_cursos', 'modulos_cursos.id', '=', 'videos_cursos.modulo_id')
        ->where('modulos_cursos.curso_id', $this->curso->id)
        ->pluck('videos_cursos.id'); // Obtener solo los IDs de videos

        // Obtener los IDs de videos de los videos completados
        $VideosCompletadosIds = DB::table('videos_completados')
        ->where('estudiante_id', Auth::user()->id)
        ->pluck('videos_id'); // Obtener solo los IDs de videos

        // Calcular la intersección y contar los elementos
        $videosVistos = $videosIdsCurso->intersect($VideosCompletadosIds)->count();

        //Calcuar porcentaje
        if ($videosTotales > 0){

            $this->porcentaje =  round(($videosVistos / $videosTotales) * 100);
        } else {

            $this->porcentaje = 0;
          }
       }
    }

    /*=====================
         LIKE/DISLIKE
     =====================*/
    public function toggleLike($id){


        if($this->dislikeValidate){

          $record = Like::where('video_id', $id)->first();

           $record->update([ 
            'dislike' => 0,
            'like' => 1,
           ]);

        } else{

            //Validamos si ya el usuario completó el video
            if(!$this->likeValidate){

                // Guardar registro si el switch se activa
                Like::create([
                    'like' => 1,
                    'estudiante_id' => auth()->id(),
                    'video_id' => $this-> videoIdSave,
                ]);

                session()->flash('info', 'Gracias por apoyar los videos de este curso. Los videos a los que les des like estarán en tu lista de favoritos, ¡ten en cuenta revisar esta función más tarde!.');

            } else {

            // Borrar el registro si el switch se desactiva
                Like::where('estudiante_id', auth()->id())
                ->where('video_id', $this-> videoIdSave)
                ->delete();
            }        

        }
    }

    public function toggleDislike($id){

        if($this->likeValidate){

            $record = Like::where('video_id', $id)->first();

            $record->update([ 
                'dislike' => 1,
                'like' => 0,
            ]);

        } else{

           //Validamos si ya el usuario completó el video
            if(!$this->dislikeValidate){

                // Guardar registro si el switch se activa
                Like::create([
                    'dislike' => 1,
                    'estudiante_id' => auth()->id(),
                    'video_id' => $this-> videoIdSave,
                ]);

            } else {

                // Borrar el registro si el switch se desactiva
                Like::where('estudiante_id', auth()->id())
                ->where('video_id', $this-> videoIdSave)
                ->delete();
            }        

        }
    }

    /*=====================
          CALIFACIÓN
    =====================*/
    public function calificacion($estrellas){

        if($estrellas >= 1 && $estrellas <= 5){

            CalificacionCurso::create([ 
                'estudiante_id' => Auth::user()->id,
                'calificacion' => $estrellas,
                'curso_id' => $this->curso->id,
            ]);

          $this->dispatchBrowserEvent('closeModal');
          session()->flash('calification', '¡Gracias por calificar este curso!');

        }         
    }



    /*=====================
          COMENTARIOS
     =====================*/
    public function toggleComentario(){

        //Si la caja de descripción está desplegada
        if($this->comentarioActive){

            //Cerrar caja de descripción
            $this->comentarioActive = false;

        //Si la caja de descripción esta cerrada
        } else{

            //Abrir caja de descripción
            $this->comentarioActive = true;
        }
    }

    //Guardar comentario
     public function storeComentario(){

        //Validar datos
        $this->validate([
            'comentario' => 'required',
        ]);

      //Validamos si el comentario no tiene una mala palabra
      $result = Gemini::geminiPro()->generateContent('Verifica si este comentario de un curso es ofensivo o tiene malas palabras. De serlo, retorna en tu respuesta solamente un true, de no tener un comentario ofensivo retorna un false. sin dialogos adicionales y solamente una respuesta. El comentario en cuestion es: '.$this->comentario);

      //Validamos la respuesta de Gemini
      if(str_replace(["\n","*"], "", $result->text()) == 'true' || str_replace(["\n","*"], "", $result->text()) == 'True'){

        //Mensaje de error
        session()->flash('comentario-error', 'Se detectó que su comentario es ofensivo. Verifique o intente de nuevo.');

      //El comentario es valido y se guarda
     }else if(str_replace(["\n","*"], "", $result->text()) == 'false' || str_replace(["\n","*"], "", $result->text()) == 'False'){

        //Guardar el comentario
        ComentariosCurso::create([ 
            'comentario' => $this-> comentario,
            'usuario_id' => Auth::user()->id,
            'curso_id' => $this->curso->id,
        ]);

        //Resetear campos
        $this->resetInput();

      }

      else{

        //Mensaje de error
        session()->flash('comentario-error', 'Ha ocurrido un error de conexión con Gemini IA.');
      }
    }

    //Editar comentario
    public function editComentario($id){
        $record = ComentariosCurso::findOrFail($id);
        $this->selected_id = $id; 
        $this->comentario_update = $record-> comentario;
    }

    //Actualizar comentario
    public function updateComentario(){

        $this->validate([
            'comentario_update' => 'required',
        ]);

        //Validamos si el comentario no tiene una mala palabra
        $result = Gemini::geminiPro()->generateContent('Verifica si este comentario de un curso es ofensivo o tiene malas palabras. De serlo retorna en tu respuesta un true. El comentario es: '.$this->comentario_update);

      //Validamos la respuesta de Gemini
        if(str_replace(["\n","*"], "", $result->text()) == 'true' || str_replace(["\n","*"], "", $result->text()) == 'True'){

            //Mensaje de error
            session()->flash('comentario-error-modal', 'Se detectó que su comentario es ofensivo. Verifique o intente de nuevo.');

        //El comentario es valido y se guarda
        } else if(str_replace(["\n","*"], "", $result->text()) == 'false' || str_replace(["\n","*"], "", $result->text()) == 'False'){

            if ($this->selected_id){

                $record = ComentariosCurso::find($this->selected_id);
                $record->update([ 
                    'comentario' => $this-> comentario_update,
                    'usuario_id' => Auth::user()->id,
                    'curso_id' => $this->curso->id,
                ]);

                //Resetear campos
                $this->resetInput();

                //Cerrar modal
                $this->dispatchBrowserEvent('closeModal');
            }
        }

        else{

        //Mensaje de error
        session()->flash('comentario-error', 'Ha ocurrido un error de conexión con Gemini IA.');

        }
    }

    //Eliminar comentario
    public function destroyComentario($id){

        if ($id) {
            ComentariosCurso::where('id', $id)->delete();
        }
    }

    //Cerrar modal
    public function cancel(){

        $this->resetInput();
    }
    
    //Resetar inputs
    private function resetInput(){

        $this->comentario = null;
        $this->comentario_update = null;
    }
}
