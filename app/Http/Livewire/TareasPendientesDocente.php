<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente de Gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\Tarea;
use App\Models\ClassroomUser;
use App\Models\Auditoria;

//Clase principal
class TareasPendinteDocente extends Component{

    //Componente - Paginación
    use WithPagination;

    //Componente - Carga / Subida de videos u archivos
    use WithFileUploads;

    //Integración con Bootstrap
    protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre, $descripcion, $documento, $classroom_id, $fecha_entrega, $classrooms, $estudiantes_count;

    //Render
    public function render(){

      $tareas = Tarea::query()
          ->where('classroom_id', $this->classroom_id)
          ->when($this->keyWord, function ($query, $keyWord) {
              $query->where(function ($query) use ($keyWord) {
                  $query->where('nombre', 'LIKE', '%' . $keyWord . '%');
                  $query->orWhere('fecha_entrega', 'LIKE', '%' . $keyWord . '%');
              });
          })
          ->withCount(['tareasEntregadas'])
          ->paginate(10);

        //Retornamos la vista
        return view('livewire.tareas-corregido-docente.view', [
            'tareas' => $tareas,
        ]);
    }

    //Buscamos datos adicionales
    public function mount($id){

      $this->classroom_id = $id;

      $this->estudiantes_count = ClassroomUser::where('classroom_id', $this->classroom_id)->count();
    }
}