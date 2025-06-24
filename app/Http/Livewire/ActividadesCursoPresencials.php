<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActividadesCursoPresencial;
use App\Models\Aula;

class ActividadesCursoPresencials extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $curso_presencial_id, $aula_id, $fecha_ini, $fecha_fin, $aulas;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.actividades-curso-presencials.view', [
            'actividadesCursoPresencials' => ActividadesCursoPresencial::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('curso_presencial_id', 'LIKE', $keyWord)
						->orWhere('aula_id', 'LIKE', $keyWord)
						->orWhere('fecha_ini', 'LIKE', $keyWord)
						->orWhere('fecha_fin', 'LIKE', $keyWord)
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
		$this->curso_presencial_id = null;
		$this->aula_id = null;
		$this->fecha_ini = null;
		$this->fecha_fin = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'curso_presencial_id' => 'required',
		'aula_id' => 'required',
		'fecha_ini' => 'required',
		'fecha_fin' => 'required',
        ]);

        ActividadesCursoPresencial::create([ 
			'nombre' => $this-> nombre,
			'curso_presencial_id' => $this-> curso_presencial_id,
			'aula_id' => $this-> aula_id,
			'fecha_ini' => $this-> fecha_ini,
			'fecha_fin' => $this-> fecha_fin
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ActividadesCursoPresencial Successfully created.');
    }

    public function edit($id)
    {
        $record = ActividadesCursoPresencial::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->curso_presencial_id = $record-> curso_presencial_id;
		$this->aula_id = $record-> aula_id;
		$this->fecha_ini = $record-> fecha_ini;
		$this->fecha_fin = $record-> fecha_fin;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'curso_presencial_id' => 'required',
		'aula_id' => 'required',
		'fecha_ini' => 'required',
		'fecha_fin' => 'required',
        ]);

        if ($this->selected_id) {
			$record = ActividadesCursoPresencial::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'curso_presencial_id' => $this-> curso_presencial_id,
			'aula_id' => $this-> aula_id,
			'fecha_ini' => $this-> fecha_ini,
			'fecha_fin' => $this-> fecha_fin
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'ActividadesCursoPresencial Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ActividadesCursoPresencial::where('id', $id)->delete();
        }
    }

    public function mount($id){

    	//Guardar el id del curso
    	$this->curso_presencial_id = $id;

    	//Aulas
    	$this->aulas = Aula::all();
    }
}