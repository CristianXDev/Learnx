<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Classroom;
use App\Models\Tarea;
use App\Models\TareasEntregada;
use App\Models\Auditoria;

//Clase principal
class TareasEntregadasPendientesDocente extends Component{

	//Componente - Paginación
    use WithPagination;

	//Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
    public $selected_id, $keyWord, $estudiante_id, $tarea_id, $documento, $fecha_entrega, $calificacion, $classrooms, $tareas;

	//Render
    public function render(){

    	//Buscar e filtrar la información
    	$tareasEntregadas = TareasEntregada::query()
    	->where('tarea_id', $this->tarea_id)
    	->where('calificacion', null)
	    ->when($this->keyWord, function ($query, $keyWord) {
	        $query->where(function ($query) use ($keyWord) {
	            $query->where('fecha_entrega', 'LIKE', '%' . $keyWord . '%')
	                ->orWhere('calificacion', 'LIKE', '%' . $keyWord . '%')
	                ->orWhereHas('tarea', function ($query) use ($keyWord) {
	                    $query->where('nombre', 'LIKE', '%' . $keyWord . '%');
	                })
	                ->orWhereHas('user', function ($query) use ($keyWord) {
	                    $query->where(function($query) use ($keyWord) {
	                      $query->where('name', 'LIKE', '%' . $keyWord . '%')
	                            ->orWhere('lastName', 'LIKE', '%' . $keyWord . '%');
	                    });
	                });
	        });
	    })->paginate(10);

        //Retornar la vista
        return view('livewire.tareas-entregadas-pendientes-docente.view', [
			'tareasEntregadas' => $tareasEntregadas,
		]);
    }
	
	//Cerrar modal
	public function cancel(){

		$this->resetInput();
	}
	
	//Resetear Campos
    private function resetInput(){

		$this->calificacion = null;
    }

 	//Inicializar variables
    public function edit($id){

        $record = TareasEntregada::findOrFail($id);
        $this->selected_id = $id; 
		$this->estudiante_id = $record-> estudiante_id;
		$this->tarea_id = $record-> tarea_id;
		$this->documento = $record-> documento;
		$this->fecha_entrega = $record-> fecha_entrega;
		$this->calificacion = $record-> calificacion;
    }

 	//Actualizar datos
    public function update(){

		//Validar campos
        $this->validate([
			'calificacion' => 'required|min:1|max:3',
        ]);

  		//Verificar el ID del aula online
        if ($this->selected_id){

        	 //Actualizar el aula online 
			$record = TareasEntregada::find($this->selected_id);
            $record->update([ 
			'estudiante_id' => $this-> estudiante_id,
			'tarea_id' => $this-> tarea_id,
			'documento' => $this-> documento,
			'fecha_entrega' => $this-> fecha_entrega,
			'calificacion' => $this-> calificacion
            ]);

            //Auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha corregido la tarea: ' . $record->tarea->nombre,
            ]);

             //Resetar inputs
            $this->resetInput();

            //Cerrar modal
            $this->dispatchBrowserEvent('closeModal');

            //Mensaje guardado en la sesión
            session()->flash('message', 'Actualizado correctamente');
        }
    }

	//Buscamos datos adicionales
    public function mount($id){

    	$this->tarea_id = $id; 
    }
}