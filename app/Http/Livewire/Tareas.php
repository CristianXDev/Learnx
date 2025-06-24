<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente de Gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\Tarea;
use App\Models\Classroom;
use App\Models\Auditoria;

//Clase principal
class Tareas extends Component{

    //Componente - Paginación
    use WithPagination;

    //Componente - Carga / Subida de videos u archivos
    use WithFileUploads;

    //Integración con Bootstrap
    protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre, $descripcion, $documento, $classroom_id, $fecha_entrega, $classrooms;

    //Render
    public function render(){

        //Buscar e filtrar la información
    	$keyWord = '%'.$this->keyWord .'%';
    	return view('livewire.tareas.view', [
    		'tareas' => Tarea::latest()
    		->orWhere('nombre', 'LIKE', $keyWord)
    		->orWhere('descripcion', 'LIKE', $keyWord)
    		->orWhere('documento', 'LIKE', $keyWord)
    		->orWhere('classroom_id', 'LIKE', $keyWord)
    		->orWhere('fecha_entrega', 'LIKE', $keyWord)
    		->paginate(10),
		]);
    }

    //Cerrar modal
    public function cancel(){

        $this->resetInput();
    }

    //Resetear Campos
    private function resetInput(){

    	$this->nombre = null;
    	$this->descripcion = null;
    	$this->documento = null;
    	$this->classroom_id = null;
    	$this->fecha_entrega = null;
    }

    //Agregar datos
    public function store(){

        //Validar campos
    	$this->validate([
    		'nombre' => 'required',
    		'descripcion' => 'required',
    		'documento' => 'nullable|file|mimes:pdf,docx',
    		'classroom_id' => 'required',
    		'fecha_entrega' => 'required',
    	]);

        //Verificar si existe 
    	if($this->documento){

            //Crear tarea con el documento
    		Tarea::create([ 
    			'nombre' => $this-> nombre,
    			'descripcion' => $this-> descripcion,
    			'documento' => $this->documento->store('public/tareas'),
    			'classroom_id' => $this-> classroom_id,
    			'fecha_entrega' => $this-> fecha_entrega
    		]);
    	}

        //Caso contrario
    	else{

            //Crear tarea sin el documento
    		Tarea::create([ 
    			'nombre' => $this-> nombre,
    			'descripcion' => $this-> descripcion,
    			'classroom_id' => $this-> classroom_id,
    			'fecha_entrega' => $this-> fecha_entrega
    		]);	
    	}

        //Auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado la tarea: ' . $this->nombre,
        ]);

        //Resetar inputs
        $this->resetInput();

        //Cerrar modal
        $this->dispatchBrowserEvent('closeModal');

         //Mensaje guardado en la sesión
        session()->flash('message', 'Creado correctamente');
    }

    //Inicializar variables
    public function edit($id){

    	$record = Tarea::findOrFail($id);
    	$this->selected_id = $id; 
    	$this->nombre = $record-> nombre;
    	$this->descripcion = $record-> descripcion;
    	$this->documento = $record-> documento;
    	$this->classroom_id = $record-> classroom_id;
    	$this->fecha_entrega = $record-> fecha_entrega;
    }

    //Actualizar datos
    public function update(){

        //Validar campos
    	$this->validate([
    		'nombre' => 'required',
    		'descripcion' => 'required',
    		'classroom_id' => 'required',
    		'fecha_entrega' => 'required',
    	]);

        //Verificar el ID del aula online
    	if($this->selected_id){

            //Actualizar el aula online
    		$record = Tarea::find($this->selected_id);
    		$record->update([ 
    			'nombre' => $this-> nombre,
    			'descripcion' => $this-> descripcion,
    			'documento' => $this-> documento,
    			'classroom_id' => $this-> classroom_id,
    			'fecha_entrega' => $this-> fecha_entrega
    	   ]);

            //Auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha actualizado la tarea: ' . $this->nombre,
            ]);

            //Resetar inputs
            $this->resetInput();

            //Cerrar modal
            $this->dispatchBrowserEvent('closeModal');

            //Mensaje guardado en la sesión
            session()->flash('message', 'Actualizado correctamente');
    	}
    }

    //Eliminar aula online
    public function destroy($id){

        //Verificar si existe el ID
    	if($id){

            //Borrar aula online
    		Tarea::where('id', $id)->delete();
    	}
    }

    //Buscamos datos adicionales
    public function mount(){

        //Traer el listado de las aulas
        $this->classrooms = Classroom::where('profesor_id',Auth::user()->id)->get();
    }

    //Funciónde gemini (Mejorar el nombre del aula online)
    public function geminiNombre(){

        //Validar campos
    	$this->validate([
    		'nombre' => 'required|string|max:255', 
    	]);

       //Establcemos los datos de la consulta
    	$result = Gemini::geminiPro()->generateContent(
    		'Mejora la redacción de este titulo de mi tarea para unos estudiantes y hazlo un poco más llamativo y simple: '. $this->nombre .
    		'Necestio que la redacción sea limpia y sin dialogos adicionales.
            Solamente una respuesta.'
    	);

        //solicitamos la respuesta a gemini
    	$result = $result->text();

        //Guardar el nuevo nombre (formateando el texto)
    	$this->nombre = str_replace("*", "", $result);
    }

    //Funciónde gemini (Mejorar la descripción del aula online)
    public function geminiDescripcion(){

        //Validar campos
    	$this->validate([
    		'descripcion' => 'required|string|max:255', 
    	]);

        //Establcemos los datos de la consulta
    	$result = Gemini::geminiPro()->generateContent(
    		'Mejora la redacción de esta descripcion de mi tarea para mis estudiantes y hazlo un poco más llamativo: '. $this->descripcion .
    		'Necestio que la redacción sea limpia y sin dialogos adicionales.
            Solamente una respuesta.'
    	);

        //solicitamos la respuesta a gemini
    	$result = $result->text();

        //Guardar la nueva descripción (formateando el texto)
    	$this->descripcion = str_replace("*", "", $result);
    }
}