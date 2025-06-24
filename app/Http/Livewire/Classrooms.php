<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Componente para generar el código de acceso
use Illuminate\Support\Str; 

//Componente de Gemini
use Gemini\Laravel\Facades\Gemini;

//Modelos
use App\Models\Classroom;
use App\Models\Materia;
use App\Models\Auditoria;
use App\Models\ClassroomUser;

//Clase principal
class Classrooms extends Component{

 	//Componente - Paginación
	use WithPagination;

	//Componente - Carga / Subida de videos u archivos
	use WithFileUploads;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

	//Variables
	public $selected_id, $keyWord, $foto, $nombre, $descripcion, $profesor_id, $materia_id, $codigo_acceso, $estatus, $tipo, $max_estudiantes, $materias;

 	//Render
	public function render(){

		//Buscar e filtrar la información
    	$classrooms = Classroom::query()
    	->where('profesor_id', Auth::user()->id)
        ->when($this->keyWord, function ($query, $keyWord) {
        	$query->where(function ($query) use ($keyWord) {
        		$query->where('nombre', 'LIKE', $keyWord)
        		->orWhere('codigo_acceso', 'LIKE', $keyWord)
        		->orWhere('estatus', 'LIKE', $keyWord)
        		->orWhere('tipo', 'LIKE', $keyWord)
        		->orWhereHas('materia', function ($query) use ($keyWord) {
        			$query->where('nombre', 'LIKE', '%' . $keyWord . '%');
        		});
        	});
        })->paginate(10);

        //Retornar la vista
		return view('livewire.classrooms.view', [
			'classrooms' => $classrooms,
		]);
	}

	//Cerrar modal
	public function cancel(){

		$this->resetInput();
	}
	
	//Resetear Campos
	private function resetInput(){

		$this->foto = null;
		$this->nombre = null;
		$this->descripcion = null;
		$this->profesor_id = null;
		$this->materia_id = null;
		$this->codigo_acceso = null;
		$this->estatus = null;
		$this->tipo = null;
		$this->max_estudiantes = null;
	}

    //Agregar datos
	public function store(){

	//Validar campos
	$this->validate([
		'foto' => 'required|image|mimes:jpeg,png,jpg',
		'nombre' => 'required|string|max:255', 
		'descripcion' => 'required|string',
		'materia_id' => 'required|exists:materias,id',
		'tipo' => 'required|in:publico,privado',
		'max_estudiantes' => 'required|integer',
	]);

    //Genera un código de acceso aleatorio
    $codigoAcceso = Str::random(10); // Genera un código de 10 caracteres aleatorios

   //Crear un aula virtual
   $classroom = Classroom::create([
        'foto' => $this->foto->store('public/classrooms'), // Guarda la foto en la carpeta 'classrooms'
        'nombre' => $this->nombre,
        'descripcion' => $this->descripcion,
        'profesor_id' => auth()->user()->id,
        'materia_id' => $this->materia_id,
        'codigo_acceso' => $codigoAcceso,
        'estatus' => 'activo',
        'tipo' => $this->tipo,
        'max_estudiantes' => $this->max_estudiantes
    ]);

    //Inscribir al profesor en el aula que acaba de crear
    ClassroomUser::create([ 
    	'usuario_id' => Auth::user()->id,
    	'classroom_id' => $classroom->id,
    ]);

	//Auditoria
    Auditoria::create([ 
    	'usuario_id' => Auth::user()->id,
    	'descripcion' => 'El usuario ha agregado el aula: ' . $this->nombre,
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

	$record = Classroom::findOrFail($id);
	$this->selected_id = $id; 
	$this->foto = $record-> foto;
	$this->nombre = $record-> nombre;
	$this->descripcion = $record-> descripcion;
	$this->profesor_id = $record-> profesor_id;
	$this->materia_id = $record-> materia_id;
	$this->codigo_acceso = $record-> codigo_acceso;
	$this->estatus = $record-> estatus;
	$this->tipo = $record-> tipo;
	$this->max_estudiantes = $record-> max_estudiantes;
}

//Actualizar datos
public function update(){

    //Validar campos
	$this->validate([
        'foto' => 'nullable|image',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'materia_id' => 'required|exists:materias,id',
        'tipo' => 'required|in:publico,privado',
        'max_estudiantes' => 'required|integer',
    ]);

   	//Verificar el ID del aula online
	if ($this->selected_id){

		//Actualizar el aula online
		$record = Classroom::find($this->selected_id);
		$record->update([ 
			'foto' => $this->foto && $this->foto->isValid() ? $this->foto->store('public/classrooms') : $this->foto,
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
			'materia_id' => $this->materia_id,
			'tipo' => $this->tipo,
			'max_estudiantes' => $this->max_estudiantes
		]);

		//Auditoria
		Auditoria::create([ 
			'usuario_id' => Auth::user()->id,
			'descripcion' => 'El usuario ha actualizado la materia: ' . $this->nombre,
		]);

		//Resetar inputs
		$this->resetInput();

		//Cerrar modal
		$this->dispatchBrowserEvent('closeModal');

		//Mensaje guardado en la sesión
		session()->flash('message', 'Actualizado correctamente');
	}
}

//Actualizar estaus
public function updateEstatus(){

	//Validar campos
	$this->validate([
		'estatus' => 'required|in:activo,inactivo',
	]);

   	//Verificar el ID del aula online
	if ($this->selected_id) {
		$record = Classroom::find($this->selected_id);
		$record->update([ 
			'estatus' => $this->estatus,
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

		//Auditoria
		Auditoria::create([ 
			'usuario_id' => Auth::user()->id,
			'descripcion' => 'El usuario ha eliminado un aula',
		]);

		//Borrar aula online
		Classroom::where('id', $id)->delete();
	}
}

//Buscamos datos adicionales
public function mount(){

	//Traer el listado de las materias
	$this->materias = Materia::all();
}

//Funciónde gemini (Mejorar el nombre del aula online)
public function geminiNombre(){

	//Validar campos
	$this->validate([
		'nombre' => 'required|string|max:255', 
	]);

	//Establcemos los datos de la consulta
	$result = Gemini::geminiPro()->generateContent(
		'Mejora la redacción de este titulo de mi aula y hazlo un poco más llamativo: '. $this->nombre .
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
		'Mejora la redacción de esta descripcion de mi aula y hazlo un poco más llamativo: '. $this->descripcion .
		'Necestio que la redacción sea limpia y sin dialogos adicionales.
		Solamente una respuesta.'
	);

	//solicitamos la respuesta a gemini
	$result = $result->text();

	//Guardar la nueva descripción (formateando el texto)
	$this->descripcion = str_replace("*", "", $result);
}

//Cambiar codigo del aula
public function changeCode($id){

	   	//Verificar el ID del aula online
		if($id){

			//Buscamos el aula online por su id
			$record = Classroom::find($id);

			//Actualizamos el codigo de acceso
			$record->update([ 
				'codigo_acceso' => Str::random(10),
			]);

			//Resetar inputs
			$this->resetInput();

			//Cerrar modal
			$this->dispatchBrowserEvent('closeModal');

			//Mensaje guardado en la sesión
			session()->flash('message', '¡El nuevo código fue generado!');
		}
	}
}