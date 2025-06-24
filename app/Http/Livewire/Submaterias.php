<?php

namespace App\Http\Livewire;

//Componentes
use Livewire\Component;
use Livewire\WithPagination;

//Modelos
use App\Models\Submateria;
use App\Models\Materia;
use App\Models\Auditoria;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Clase principal
class Submaterias extends Component{

    //Componente - Paginación
    use WithPagination;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre, $materias, $materia_id;

    //Render
    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.submaterias.view', [
            'submaterias' => Submateria::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('materia_id', 'LIKE', $keyWord)
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
		$this->materia_id = null;
    }

    //Agregar datos
    public function store(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
		'materia_id' => 'required',
        ]);

        //Crear Tema
        Submateria::create([ 
			'nombre' => $this-> nombre,
			'materia_id' => $this-> materia_id
        ]);

        //Registro de auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado el tema: ' . $this->nombre,
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

        $record = Submateria::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->materia_id = $record-> materia_id;
    }

    //Actualizar datos
    public function update(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
		'materia_id' => 'required',
        ]);

        //Verificar el ID de la materia
        if ($this->selected_id){

             //Actualizar materia
			$record = Submateria::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'materia_id' => $this-> materia_id
            ]);

             //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha actualizado el tema: ' . $this->nombre,
            ]);

            //Resetar inputs
            $this->resetInput();

            //Cerrar modal
            $this->dispatchBrowserEvent('closeModal');

             //Mensaje guardado en la sesión
			session()->flash('message', 'Actualizado correctamente');
        }
    }

    //Eliminar materia
    public function destroy($id){

        //Verificar si existe el ID
        if($id){

            //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario eliminado una materia',
            ]);

            //Borrar materia
            Submateria::where('id', $id)->delete();
        }
    }

    //Buscamos datos adicionales
    public function mount(){

        //Registro de materias
        $this->materias = Materia::all();
    }


}