<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Modelos
use App\Models\QuizCurso;
use App\Models\ModulosCurso;

//Clase principal
class QuizCursos extends Component{

	//Componente - Paginación
    use WithPagination;

	//Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
    public $selected_id, $keyWord, $pregunta, $respuesta_1, $respuesta_2, $respuesta_3, $respuesta_4, $modulo;

	//Render
    public function render(){

    $quizCursos = QuizCurso::query()
    ->where('modulo_id', $this->modulo->id)
    ->when($this->keyWord, function ($query, $keyWord) {
    	$query->where(function ($query) use ($keyWord) {
    		$query->where('pregunta', 'LIKE', '%' . $keyWord . '%')
    		->orWhere('respuesta_1', 'LIKE', '%' . $keyWord . '%')
    		->orWhere('respuesta_2', 'LIKE', '%' . $keyWord . '%')
    		->orWhere('respuesta_3', 'LIKE', '%' . $keyWord . '%')
    		->orWhere('respuesta_4', 'LIKE', '%' . $keyWord . '%');
    	});
    })
        ->paginate(10); // Paginación aplicada al final de la consulta

    // Retornamos la vista
        return view('livewire.quiz-cursos.view', [
        	'quizCursos' => $quizCursos,
        ]);
    }
	
	//Cerrar modal
    public function cancel(){

        $this->resetInput();
    }
	
	//Resetear Campos 
    private function resetInput(){

		$this->pregunta = null;
		$this->respuesta_1 = null;
		$this->respuesta_2 = null;
		$this->respuesta_3 = null;
		$this->respuesta_4 = null;
    }

	//Agregar datos
    public function store(){

    	//Validar campos
        $this->validate([
		'pregunta' => 'required',
		'respuesta_1' => 'required',
		'respuesta_2' => 'required',
        ]);

 		//Crear un modulo
        QuizCurso::create([ 
			'pregunta' => $this-> pregunta,
			'respuesta_1' => $this-> respuesta_1,
			'respuesta_2' => $this-> respuesta_2,
			'respuesta_3' => $this-> respuesta_3,
			'respuesta_4' => $this-> respuesta_4,
			'modulo_id' => $this->modulo->id,
        ]);
        
    	//Resetar inputs
        $this->resetInput();

    	//Cerrar modal
        $this->dispatchBrowserEvent('closeModal');

     	//Mensaje guardado en la sesión
        session()->flash('message', 'Creado correctamente');
    }

    public function edit($id)
    {
        $record = QuizCurso::findOrFail($id);
        $this->selected_id = $id; 
		$this->pregunta = $record-> pregunta;
		$this->respuesta_1 = $record-> respuesta_1;
		$this->respuesta_2 = $record-> respuesta_2;
		$this->respuesta_3 = $record-> respuesta_3;
		$this->respuesta_4 = $record-> respuesta_4;
		$this->modulo_id = $record-> modulo_id;
    }

	//Inicializar variables
    public function update(){

    	//Validar campos
        $this->validate([
		'pregunta' => 'required',
		'respuesta_1' => 'required',
		'modulo_id' => 'required',
        ]);

        //Verificar el ID del aula online
        if ($this->selected_id){

        	 //Actualizar el modulo
			$record = QuizCurso::find($this->selected_id);
            $record->update([ 
			'pregunta' => $this-> pregunta,
			'respuesta_1' => $this-> respuesta_1,
			'respuesta_2' => $this-> respuesta_2,
			'respuesta_3' => $this-> respuesta_3,
			'respuesta_4' => $this-> respuesta_4,
			'modulo_id' => $this-> modulo_id
            ]);

			//Resetar inputs
	        $this->resetInput();

	        //Cerrar modal
	        $this->dispatchBrowserEvent('closeModal');

	        //Mensaje guardado en la sesión
	        session()->flash('message', 'Actualizado correctamente');
        }
    }

	//Eliminar modulo
    public function destroy($id){

    	//Verificar si existe el ID
        if($id){

        	//Borrar modulo
            QuizCurso::where('id', $id)->delete();
        }
    }

    //Buscamos datos adicionales
    public function mount($id){

    	//Guardar el id del curso
    	$this->modulo = ModulosCurso::find($id);
    }
}