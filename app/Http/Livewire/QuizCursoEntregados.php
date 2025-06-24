<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\QuizCursoEntregado;

class QuizCursoEntregados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $estudiante_id, $modulo_id, $fecha_entrega, $estatus;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.quizCursoEntregados.view', [
            'quizCursoEntregados' => QuizCursoEntregado::latest()
						->orWhere('estudiante_id', 'LIKE', $keyWord)
						->orWhere('modulo_id', 'LIKE', $keyWord)
						->orWhere('fecha_entrega', 'LIKE', $keyWord)
						->orWhere('estatus', 'LIKE', $keyWord)
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
		$this->modulo_id = null;
		$this->fecha_entrega = null;
		$this->estatus = null;
    }

    public function store()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'modulo_id' => 'required',
		'fecha_entrega' => 'required',
		'estatus' => 'required',
        ]);

        QuizCursoEntregado::create([ 
			'estudiante_id' => $this-> estudiante_id,
			'modulo_id' => $this-> modulo_id,
			'fecha_entrega' => $this-> fecha_entrega,
			'estatus' => $this-> estatus
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'QuizCursoEntregado Successfully created.');
    }

    public function edit($id)
    {
        $record = QuizCursoEntregado::findOrFail($id);
        $this->selected_id = $id; 
		$this->estudiante_id = $record-> estudiante_id;
		$this->modulo_id = $record-> modulo_id;
		$this->fecha_entrega = $record-> fecha_entrega;
		$this->estatus = $record-> estatus;
    }

    public function update()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'modulo_id' => 'required',
		'fecha_entrega' => 'required',
		'estatus' => 'required',
        ]);

        if ($this->selected_id) {
			$record = QuizCursoEntregado::find($this->selected_id);
            $record->update([ 
			'estudiante_id' => $this-> estudiante_id,
			'modulo_id' => $this-> modulo_id,
			'fecha_entrega' => $this-> fecha_entrega,
			'estatus' => $this-> estatus
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'QuizCursoEntregado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            QuizCursoEntregado::where('id', $id)->delete();
        }
    }
}