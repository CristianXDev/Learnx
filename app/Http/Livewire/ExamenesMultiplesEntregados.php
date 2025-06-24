<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExamenesMultiplesEntregado;

class ExamenesMultiplesEntregados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $examen_entregado_id, $examenes_multiples_id,$estatus,$pregunta, $respuesta_1;

    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.examenes-multiples-entregados.view', [
            'examenesMultiplesEntregados' => ExamenesMultiplesEntregado::latest()
            ->where('examen_entregado_id', $this->examen_entregado_id) 
			->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->pregunta = null;
		$this->respuesta_1 = null;
        $this->estatus = null;
    }

    public function store()
    {
        $this->validate([
		'examen_entregado_id' => 'required',
		'pregunta' => 'required',
		'respuesta_1' => 'required',
        ]);

        ExamenesMultiplesEntregado::create([ 
			'examen_entregado_id' => $this-> examen_entregado_id,
			'pregunta' => $this-> pregunta,
			'respuesta_1' => $this-> respuesta_1,
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ExamenesMultiplesEntregado Successfully created.');
    }

    public function edit($id)
    {
        $record = ExamenesMultiplesEntregado::findOrFail($id);
        $this->selected_id = $id; 
		$this->examen_entregado_id = $record-> examen_entregado_id;
		$this->pregunta = $record-> pregunta;
		$this->respuesta_1 = $record-> respuesta_1;
    }

    public function update()
    {
        $this->validate([
		'estatus' => 'required',
        ]);

        if ($this->selected_id) {
			$record = ExamenesMultiplesEntregado::find($this->selected_id);
            $record->update([ 
			'estatus' => $this->estatus,
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'ExamenesMultiplesEntregado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ExamenesMultiplesEntregado::where('id', $id)->delete();
        }
    }

    public function mount($id)
    {
        $this->examen_entregado_id = $id;
    }
}