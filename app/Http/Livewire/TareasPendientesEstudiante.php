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
use App\Models\TareasEntregada;
use App\Models\Auditoria;

//Clase principal
class TareasPendientesEstudiante extends Component{

    //Componente - Paginación
    use WithPagination;

    //Componente - Carga / Subida de videos u archivos
    use WithFileUploads;

    //Integración con Bootstrap
    protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre, $descripcion, $documento, $classroom_id, $fecha_entrega, $classrooms;

    //Render
    public function render(){

     $tareas = Tarea::query()
       ->select('tareas.*', 'te.calificacion as calificacion_entregada', 'te.fecha_entrega as fecha_entrega_entregada')
       ->leftJoin('tareas_entregadas as te', function ($join) {
            $join->on('tareas.id', '=', 'te.tarea_id')
                ->where('te.estudiante_id', Auth::id());
       })
        ->selectSub(function ($query) {
              $query->selectRaw('COUNT(*)')
                 ->from('tareas_entregadas as te2')
                 ->whereColumn('te2.tarea_id', 'tareas.id')
                 ->where('te2.estudiante_id', Auth::id());
         }, 'entregado')
       ->where('tareas.classroom_id', $this->classroom_id)
       ->when($this->keyWord, function ($query, $keyWord) {
           $query->where(function ($query) use ($keyWord) {
               $query->where('tareas.nombre', 'LIKE', '%' . $keyWord . '%');
               $query->orWhere('tareas.fecha_entrega', 'LIKE', '%' . $keyWord . '%');
           });
       })
       ->paginate(10);

        //Retornamos la vista
        return view('livewire.tareas-pendientes-estudiante.view', [
            'tareas' => $tareas,
        ]);


    }

    //Buscamos datos adicionales
    public function mount($id){

      $this->classroom_id = $id;
    }
}