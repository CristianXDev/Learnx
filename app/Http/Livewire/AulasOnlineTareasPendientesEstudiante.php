<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente para generar el código de acceso
use Illuminate\Support\Str; 

//Modelos
use App\Models\Classroom;
use App\Models\Materia;
use App\Models\Tarea;
use App\Models\Auditoria;
use App\Models\ClassroomUser;

//Clase principal
class AulasOnlineTareasPendientesEstudiante extends Component{

 	//Componente - Paginación
	use WithPagination;

	//Componente - Carga / Subida de videos u archivos
	use WithFileUploads;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
	public $selected_id, $keyWord, $foto, $nombre, $profesor_id, $materias;

 	//Render
	public function render(){

  	//Buscar y filtrar la información en la tabla ClassroomUser
    $classroomsUsers = ClassroomUser::query()
        ->where('usuario_id', Auth::user()->id) // Filtrar por el ID del usuario actual
        ->when($this->keyWord, function ($query, $keyWord) {
            $query->where(function ($query) use ($keyWord) {
                $query->orWhereHas('classroom', function ($query) use ($keyWord) {
                    $query->where('nombre', 'LIKE', '%' . $keyWord . '%')
                        ->orWhereHas('materia', function ($query) use ($keyWord) {
                            $query->where('nombre', 'LIKE', '%' . $keyWord . '%');
                        });
                });
            });
        })
        ->with(['classroom' => function ($query){
           $query->withCount('tareas');
         }])
         // Cargar la relación classroom y dentro de ella contar las tareas
        ->paginate(10);

		//Retornar la vista
		return view('livewire.aulas-online-tareas-pendientes-estudiante.view', [
			'classrooms' => $classroomsUsers,
		]);
	}

//Buscamos datos adicionales
public function mount(){

	//Traer el listado de las materias
	$this->materias = Materia::all();
	}
}