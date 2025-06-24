<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//Componente de Gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\VideosCurso;
use App\Models\Curso;
use App\Models\Like;

//Clase principal
class VideosCursos extends Component{

//Componente - Paginación
use WithPagination;

//Componente - Carga / Subida de videos u archivos
use WithFileUploads;

//Integración con Bootstrap
protected $paginationTheme = 'bootstrap';

//Variables
public $selected_id, $keyWord, $titulo, $descripcion, $vistas, $video, $modulo_id, $like, $dislike;

public function render(){

   //Buscar e filtrar la información
   $videosCursos = VideosCurso::query()
   ->where('modulo_id', $this->modulo_id)
   ->when($this->keyWord, function ($query, $keyWord) {
      $query->where(function ($query) use ($keyWord) {
         $query->where('titulo', 'LIKE', '%' . $keyWord . '%');
      });
   })
   ->withCount(['likes' => function($query){
      $query->where('like', 1);
   }])
   ->withCount(['likes as dislikes_count' => function($query){
      $query->where('dislike', 1);
   }])
   ->paginate(10);

   //Retornar la vista
   return view('livewire.videos-cursos.view', [
      'videosCursos' => $videosCursos,
   ]);
}

//Cerrar modal
public function cancel(){

   $this->resetInput();
}

//Resetear Campos
private function resetInput(){

   $this->titulo = null;
   $this->descripcion = null;
   $this->video = null;
   $this->curso_id = null;
}

//Agregar datos
public function store(){

   //Validar campos
   $this->validate([
      'titulo' => 'required',
      'descripcion' => 'required',
      'video' => 'required',
   ]);

   //Crear un video
   VideosCurso::create([ 
      'titulo' => $this->titulo,
      'descripcion' => $this->descripcion,
      'video' => $this->video->store('public/videos-cursos'),
      'modulo_id' => $this->modulo_id,
   ]);

   //Resetar inputs
    $this->resetInput();

    //Cerrar modal
    $this->dispatchBrowserEvent('closeModal');

     //Mensaje guardado en la sesión
    session()->flash('message', 'Creado correctamente');
}

//Inicializar variables
public function edit($id){

   $record = VideosCurso::findOrFail($id);
   $this->selected_id = $id; 
   $this->titulo = $record->titulo;
   $this->descripcion = $record->descripcion;
   $this->video = $record->video;
   $this->modulo_id = $record->modulo_id;

   $this->dispatchBrowserEvent('video-updated');
}

//Actualizar datos
public function update(){

   //Validar campos
   $this->validate([
      'titulo' => 'required',
      'descripcion' => 'required',
      'video' => 'required',
   ]);

   //Verificar el ID del aula online
   if($this->selected_id){

      //Actualizar el aula online
      $record = VideosCurso::find($this->selected_id);
      $record->update([ 
         'titulo' => $this->titulo,
         'descripcion' => $this->descripcion,
         'video' => $this->video,
         'modulo_id' => $this->modulo_id
      ]);

      //Resetar inputs
      $this->resetInput();

      //Cerrar modal
      $this->dispatchBrowserEvent('closeModal');

      //Mensaje guardado en la sesión
      session()->flash('message', 'Actualizado correctamente');
   }
}

//Eliminar el video
public function destroy($id){

   //Verificar si existe el ID
   if($id){

      //Borrar el video
      VideosCurso::where('id', $id)->delete();
   }
}

//Buscamos datos adicionales
public function mount($id){

   //Guardamos el id del modulo actual
   $this->modulo_id = $id;
}

//Funciónde gemini (Mejorar el nombre del video)
public function geminiNombre(){

   //Validar campos
   $this->validate([
      'titulo' => 'required|string|max:255', 
   ]);

   //Establcemos los datos de la consulta
   $result = Gemini::geminiPro()->generateContent(
      'Mejora la redacción de este titulo de mi video y hazlo un poco más llamativo: '. $this->titulo .
      'Necestio que la redacción sea limpia y sin dialogos adicionales.
      Solamente una respuesta.'
   );

   //solicitamos la respuesta a gemini
   $result = $result->text();

   //Guardar el nuevo nombre (formateando el texto)
   $this->titulo = str_replace("*", "", $result);
}

//Funciónde gemini (Mejorar la descripción del video)
public function geminiDescripcion(){

   //Validar campos
   $this->validate([
      'descripcion' => 'required|string|max:255', 
   ]);

   //Establcemos los datos de la consulta
   $result = Gemini::geminiPro()->generateContent(
      'Mejora la redacción de esta descripcion de mi video y hazlo un poco más llamativo: '. $this->descripcion .
      'Necestio que la redacción sea limpia y sin dialogos adicionales.
      Solamente una respuesta.'
   );

   //solicitamos la respuesta a gemini
   $result = $result->text();

   //Guardar la nueva descripción (formateando el texto)
   $this->descripcion = str_replace("*", "", $result);;

   }
}