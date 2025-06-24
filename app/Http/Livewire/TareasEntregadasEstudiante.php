<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\TareasEntregada;
use App\Models\Auditoria;

//Clase principal
class TareasEntregadasEstudiante extends Component{

	//Componente - Paginación
    use WithPagination;

	//Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
    public $selected_id, $keyWord, $estudiante_id, $tarea_id, $documento, $fecha_entrega, $calificacion;

	//Render
    public function render(){

		//Buscar e filtrar la información
    	$tareasEntregadas = TareasEntregada::query()
    	->where('estudiante_id', Auth::user()->id)
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
        return view('livewire.tareas-entregadas-estudiante.view', [
			'tareasEntregadas' => $tareasEntregadas,
		]);
    }
}