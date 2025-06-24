<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Examene;
use App\Models\Materia;
use App\Models\Submateria;
use Carbon\Carbon;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Auth;
use Gemini\Laravel\Facades\Gemini;

class Examenes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion, $tipo, $fecha_inicio, $fecha_fin, $lim_tiempo, $estatus, $materia_id, $submateria_id, $materia, $classroom, $submateria, $profesor_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.examenes.view', [
            'examenes' => Examene::latest()
            ->where('profesor_id', Auth::user()->id) 
			->with('materia', 'submateria') // Incluye las relaciones en la consulta
			->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->descripcion = null;
		$this->tipo = null;
		$this->fecha_inicio = null;
		$this->fecha_fin = null;
		$this->lim_tiempo = null;
		$this->estatus = null;
		$this->materia_id = null;
		$this->submateria_id = null;
		$this->classroom_id = null;
		$this->profesor_id = null;
    }

    public function store(){
    	
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
		'tipo' => 'required',
		'fecha_inicio' => 'required',
		'fecha_fin' => 'required',
		'materia_id' => 'required',
		'submateria_id' => 'required',
        ]);

        Examene::create([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'tipo' => $this-> tipo,
			'fecha_inicio' => $this-> fecha_inicio,
			'fecha_fin' => $this-> fecha_fin,
			'lim_tiempo' => $this-> lim_tiempo,
			'estatus' => 'activo',
			'materia_id' => $this-> materia_id,
			'submateria_id' => $this-> submateria_id,
			'profesor_id' => Auth::user()->id,
        ]);

		//Auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado el examen: ' . $this->nombre,
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Examene Successfully created.');
    }

    public function edit($id)
    {
        $record = Examene::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		$this->tipo = $record-> tipo;
		$this->fecha_inicio = $record-> fecha_inicio;
		$this->fecha_fin = $record-> fecha_fin;
		$this->lim_tiempo = $record-> lim_tiempo;
		$this->estatus = $record-> estatus;
		$this->materia_id = $record-> materia_id;
		$this->submateria_id = $record-> submateria_id;
    }

    public function estatus($id){

        $record = Examene::findOrFail($id);
		$this->estatus = $record-> estatus;
    }


    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
		'tipo' => 'required',
		'fecha_inicio' => 'required',
		'fecha_fin' => 'required',
		'materia_id' => 'required',
		'submateria_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Examene::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
			'tipo' => $this-> tipo,
			'fecha_inicio' => $this-> fecha_inicio,
			'fecha_fin' => $this-> fecha_fin,
			'lim_tiempo' => $this-> lim_tiempo,
			'materia_id' => $this-> materia_id,
			'submateria_id' => $this-> submateria_id,
			'profesor_id'=> Auth::user()->id,
            ]);

			//Auditoria
            Auditoria::create([ 
            	'usuario_id' => Auth::user()->id,
            	'descripcion' => 'El usuario ha editado el examen: ' . $this->nombre,
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Examene Successfully updated.');
        }
    }

    public function updateEstatus($id){
    	
    $record = Examene::findOrFail($id); // Obtén el registro

    // Actualiza el estatus
    $record->estatus = $record->estatus === 'activo' ? 'inactivo' : 'activo'; 
    $record->save();

    // Actualiza el valor en la propiedad de Livewire para que se refleje en la vista
    $this->estatus = $record->estatus;

    // Puedes emitir un evento para actualizar la vista o emitir un mensaje flash
    $this->dispatchBrowserEvent('estatusUpdated', ['estatus' => $this->estatus]); 
    //session()->flash('message', 'Estatus actualizado correctamente.');
}

    public function destroy($id)
    {
        if ($id){

        	//Auditoria
	        Auditoria::create([ 
	            'usuario_id' => Auth::user()->id,
	            'descripcion' => 'El usuario ha eliminado un examen',
	        ]);

            Examene::where('id', $id)->delete();
        }
    }

    public function mount() {
    	$this->materias = Materia::all(); // Reemplaza 'Materia' con el nombre de tu modelo de materia

    	$this->submaterias = Submateria::all(); // Reemplaza 'Materia' con el nombre de tu modelo de materia
	}

    public function geminiNombre(){

      $this->validate([
            'nombre' => 'required|string|max:255', 
        ]);

    // 1. Conecta con Gemini (ya tienes la lógica aquí)
    $result = Gemini::geminiPro()->generateContent(
    'Mejora la redacción de este titulo de mi examen y hazlo un poco más llamativo: '. $this->nombre .
    'Necestio que la redacción sea limpia y sin dialogos adicionales. Solamente una respuesta.'
    );
    
    $result = $result->text();

    // 2. Guardar el nuevo nombre
    $this->nombre = str_replace("*", "", $result);

    }

    public function geminiDescripcion(){

    $this->validate([
         'descripcion' => 'required|string|max:255', 
    ]);

    // 1. Conecta con Gemini (ya tienes la lógica aquí)
    $result = Gemini::geminiPro()->generateContent(
    'Mejora la redacción de esta descripcion de mi examen y hazlo un poco más llamativo: '. $this->descripcion .
    'Necestio que la redacción sea limpia y sin dialogos adicionales. Solamente una respuesta.'
    );

     $result = $result->text();

    // 2. Guardar el nuevo nombre
    $this->descripcion = str_replace("*", "", $result);

    }

}