<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExamenesClasicosEntregado;

class ExamenesClasicosEntregados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $examenes_entregado_id, $examen_clasico_id, $respuesta, $estatus;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.examenes-clasicos-entregados.view', [
            'examenesClasicosEntregados' => ExamenesClasicosEntregado::latest()
						->where('examenes_entregado_id', $this->examen_entregado_id) 
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->examenes_entregado_id = null;
		$this->examen_clasico_id = null;
		$this->respuesta = null;
		$this->estatus = null;
    }

    public function store()
    {
        $this->validate([
		'examenes_entregado_id' => 'required',
		'examen_clasico_id' => 'required',
		'respuesta' => 'required',
		'estatus' => 'required',
        ]);

        ExamenesClasicosEntregado::create([ 
			'examenes_entregado_id' => $this-> examenes_entregado_id,
			'examen_clasico_id' => $this-> examen_clasico_id,
			'respuesta' => $this-> respuesta,
			'estatus' => $this-> estatus
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ExamenesClasicosEntregado Successfully created.');
    }

    public function edit($id)
    {
        $record = ExamenesClasicosEntregado::findOrFail($id);
        $this->selected_id = $id; 
		$this->examenes_entregado_id = $record-> examenes_entregado_id;
		$this->examen_clasico_id = $record-> examen_clasico_id;
		$this->respuesta = $record-> respuesta;
		$this->estatus = $record-> estatus;
    }

    public function update()
    {
        $this->validate([
		'estatus' => 'required',
        ]);

        if ($this->selected_id) {
			$record = ExamenesClasicosEntregado::find($this->selected_id);
            $record->update([ 
			'examenes_entregado_id' => $this-> examenes_entregado_id,
			'examen_clasico_id' => $this-> examen_clasico_id,
			'respuesta' => $this-> respuesta,
			'estatus' => $this-> estatus
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'ExamenesClasicosEntregado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ExamenesClasicosEntregado::where('id', $id)->delete();
        }
    }

    public function mount($id)
    {
        $this->examen_entregado_id = $id;
    }
}