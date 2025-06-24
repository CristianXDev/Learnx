<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\ExamenesMultiple;

//Clase principal
class ExamenesMultiples extends Component{

   	//Componente - Paginación
	use WithPagination;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
    public $selected_id, $keyWord, $examen_id, $pregunta, $respuesta_1, $respuesta_2, $respuesta_3, $respuesta_4;

    //Render
    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.examenes-multiples.view', [
            'examenesMultiples' => ExamenesMultiple::latest()
						->orWhere('examen_id', 'LIKE', $keyWord)
						->orWhere('pregunta', 'LIKE', $keyWord)
						->orWhere('respuesta_1', 'LIKE', $keyWord)
						->orWhere('respuesta_2', 'LIKE', $keyWord)
						->orWhere('respuesta_3', 'LIKE', $keyWord)
						->orWhere('respuesta_4', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->examen_id = null;
		$this->pregunta = null;
		$this->respuesta_1 = null;
		$this->respuesta_2 = null;
		$this->respuesta_3 = null;
		$this->respuesta_4 = null;
    }

    public function store()
    {
        $this->validate([
		'pregunta' => 'required',
		'respuesta_1' => 'required',
		'respuesta_2' => 'required',
        ]);

        ExamenesMultiple::create([ 
			'examen_id' => $this-> examen_id,
			'pregunta' => $this-> pregunta,
			'respuesta_1' => $this-> respuesta_1,
			'respuesta_2' => $this-> respuesta_2,
			'respuesta_3' => $this-> respuesta_3,
			'respuesta_4' => $this-> respuesta_4
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'ExamenesMultiple Successfully created.');
    }

    public function edit($id)
    {
        $record = ExamenesMultiple::findOrFail($id);
        $this->selected_id = $id; 
		$this->examen_id = $record-> examen_id;
		$this->pregunta = $record-> pregunta;
		$this->respuesta_1 = $record-> respuesta_1;
		$this->respuesta_2 = $record-> respuesta_2;
		$this->respuesta_3 = $record-> respuesta_3;
		$this->respuesta_4 = $record-> respuesta_4;
    }

    public function update()
    {
        $this->validate([
		'pregunta' => 'required',
		'respuesta_1' => 'required',
		'respuesta_2' => 'required',
        ]);

        if ($this->selected_id) {
			$record = ExamenesMultiple::find($this->selected_id);
            $record->update([ 
			'examen_id' => $this-> examen_id,
			'pregunta' => $this-> pregunta,
			'respuesta_1' => $this-> respuesta_1,
			'respuesta_2' => $this-> respuesta_2,
			'respuesta_3' => $this-> respuesta_3,
			'respuesta_4' => $this-> respuesta_4
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'ExamenesMultiple Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            ExamenesMultiple::where('id', $id)->delete();
        }
    }

    public function mount($id)
    {
        $this->examen_id = $id;
    }
}