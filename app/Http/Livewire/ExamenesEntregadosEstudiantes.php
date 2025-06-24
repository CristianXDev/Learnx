<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExamenesEntregado;
use Illuminate\Support\Facades\Auth;

class ExamenesEntregadosEstudiantes extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $estudiante_id, $examen_id, $calificacion, $fecha_entrega, $tiempo_entrega, $estatus;

    public function render()
    {
    	$keyWord = '%'.$this->keyWord .'%';
    	return view('livewire.examenes-entregados-estudiantes.view', [
    		'examenesEntregados' => ExamenesEntregado::latest()
    		->where('estudiante_id',1)
    		->where('estatus','corregido')
    		->paginate(10),
    	]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->estudiante_id = null;
		$this->examen_id = null;
		$this->calificacion = null;
		$this->fecha_entrega = null;
		$this->tiempo_entrega = null;
		$this->estatus = null;
    }

    public function store()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'examen_id' => 'required',
		'calificacion' => 'required',
		'fecha_entrega' => 'required',
		'tiempo_entrega' => 'required',
		'estatus' => 'required',
        ]);

        ExamenesEntregado::create([ 
			'estudiante_id' => $this-> estudiante_id,
			'examen_id' => $this-> examen_id,
			'calificacion' => $this-> calificacion,
			'fecha_entrega' => $this-> fecha_entrega,
			'tiempo_entrega' => $this-> tiempo_entrega,
			'estatus' => $this-> estatus
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ExamenesEntregado Successfully created.');
    }

    public function edit($id)
    {
        $record = ExamenesEntregado::findOrFail($id);
        $this->selected_id = $id; 
		$this->estudiante_id = $record-> estudiante_id;
		$this->examen_id = $record-> examen_id;
		$this->calificacion = $record-> calificacion;
		$this->fecha_entrega = $record-> fecha_entrega;
		$this->tiempo_entrega = $record-> tiempo_entrega;
		$this->estatus = $record-> estatus;
    }

    public function update()
    {
        $this->validate([
		'estatus' => 'required|in:pendiente,corregido,rechazado',
        ]);

        if ($this->selected_id) {
			$record = ExamenesEntregado::find($this->selected_id);
            $record->update([
			'estatus' => $this-> estatus
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'ExamenesEntregado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ExamenesEntregado::where('id', $id)->delete();
        }
    }
}