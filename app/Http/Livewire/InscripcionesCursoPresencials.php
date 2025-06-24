<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InscripcionesCursoPresencial;

class InscripcionesCursoPresencials extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $estudiante_id, $curso_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.inscripcionesCursoPresencials.view', [
            'inscripcionesCursoPresencials' => InscripcionesCursoPresencial::latest()
						->orWhere('estudiante_id', 'LIKE', $keyWord)
						->orWhere('curso_id', 'LIKE', $keyWord)
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
		$this->curso_id = null;
    }

    public function store()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'curso_id' => 'required',
        ]);

        InscripcionesCursoPresencial::create([ 
			'estudiante_id' => $this-> estudiante_id,
			'curso_id' => $this-> curso_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'InscripcionesCursoPresencial Successfully created.');
    }

    public function edit($id)
    {
        $record = InscripcionesCursoPresencial::findOrFail($id);
        $this->selected_id = $id; 
		$this->estudiante_id = $record-> estudiante_id;
		$this->curso_id = $record-> curso_id;
    }

    public function update()
    {
        $this->validate([
		'estudiante_id' => 'required',
		'curso_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = InscripcionesCursoPresencial::find($this->selected_id);
            $record->update([ 
			'estudiante_id' => $this-> estudiante_id,
			'curso_id' => $this-> curso_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'InscripcionesCursoPresencial Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            InscripcionesCursoPresencial::where('id', $id)->delete();
        }
    }
}