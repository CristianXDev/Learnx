<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ChatsClassroom;
use App\Models\ClassroomUser;
use App\Models\Classroom;
use App\Models\Tarea;
use App\Models\TareasEntregada;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChatsClassrooms extends Component
{
    use WithPagination;
    use WithFileUploads; // Usa el trait

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $classroom_id, $usuario_id, $mensaje, $documento,$tarea_id;

    public function render()
    {
        // Obtiene los usuarios del aula relacionados con el usuario actual
        $classroomUsers = ClassroomUser::where('usuario_id', Auth::user()->id)
            ->get(); // Obtiene los resultados de la consulta

        // Obtiene la info del aula actual
        $classroom = Classroom::where('id', $this->classroom_id)
            ->get(); // Obtiene los resultados de la consulta

        // Obtener ID del usuario actual
        $userId = Auth::id(); // O el método equivalente para obtener el ID del usuario logeado en tu framework

        // Obtener las IDs de las tareas entregadas por el usuario actual
        $entregadasIds = DB::table('tareas_entregadas')
        ->where('estudiante_id', $userId)
        ->pluck('tarea_id')
        ->toArray();

        // Obtener las tareas que NO están en la lista de tareas entregadas
        $tareas = Tarea::where('classroom_id', $this->classroom_id)
        ->whereNotIn('id', $entregadasIds)
        ->get();

        //Obtener los estudiantes del aula
        $estudiantes = ClassroomUser::where('classroom_id',$this->classroom_id)->get();

        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.chats-classrooms.view', [
    'chatsClassrooms' => ChatsClassroom::where('classroom_id', $this->classroom_id) // Busca por el classroom_id específico
        ->orderBy('created_at') // Ordena por fecha de creación
        ->paginate(100), // Obtiene los resultados de la consulta
    'classroomUsers' => $classroomUsers, // Pasa los usuarios del aula a la vista
    'classroom' => $classroom, // Pasa los usuarios del aula a la vista
    'classroom_id' => $this->classroom_id, // Pasa los usuarios del aula a la vista
    'tareas' => $tareas, // Pasa los usuarios del aula a la vista
    'estudiantes' => $estudiantes, // Pasa los usuarios del aula a la vista
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		#$this->classroom_id = null;
		$this->usuario_id = null;
		$this->mensaje = null;
		$this->documento = null;
    }

    public function store()
    {
        $this->validate([
		'mensaje' => 'required',
        ]);

        ChatsClassroom::create([ 
			'classroom_id' => $this-> classroom_id,
			'usuario_id' => Auth::user()->id,
			'mensaje' => $this-> mensaje,
			'documento' => $this-> documento
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ChatsClassroom Successfully created.');
    }

    public function edit($id)
    {
        $record = ChatsClassroom::findOrFail($id);
        $this->selected_id = $id; 
		$this->classroom_id = $record-> classroom_id;
		$this->usuario_id = $record-> usuario_id;
		$this->mensaje = $record-> mensaje;
		$this->documento = $record-> documento;
    }

    public function update()
    {
        $this->validate([
		'classroom_id' => 'required',
		'usuario_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = ChatsClassroom::find($this->selected_id);
            $record->update([ 
			'classroom_id' => $this-> classroom_id,
			'usuario_id' => $this-> usuario_id,
			'mensaje' => $this-> mensaje,
			'documento' => $this-> documento
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'ChatsClassroom Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ChatsClassroom::where('id', $id)->delete();
        }
    }

    public function mount($code){

        if(!isset($code)){

            $this->classroom_id = 0;
        }

        else{

          $code =  Classroom::where('codigo_acceso', $code)->get();

          $this->classroom_id = $code->first()->id;

        }
    }

    public function closeModal(){
        
        // Cierra el modal actual
        $this->emit('closeModal');
    }

    public function updateTareaId($id){

            $this->tarea_id = $id;
    }


    public function storeTarea(){

        $this->validate([
        'documento' => 'required',
        ]);

        TareasEntregada::create([ 
            'estudiante_id' => Auth::user()->id,
            'tarea_id' => $this->tarea_id,
            'documento' => $this->documento->store('public/tareas/entregadas'),
            'fecha_entrega' => Carbon::now(),
            'calificacion' => 0
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('tareaSubida');
        session()->flash('message', 'TareasEntregada Successfully created.');
    }
}