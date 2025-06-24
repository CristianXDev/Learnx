<?php

namespace App\Http\Livewire;

//Componentes
use Livewire\Component;
use Livewire\WithPagination;

//Modelos
use App\Models\Materia;
use App\Models\Auditoria;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Clase principal
class Materias extends Component{

    //Componente - Paginación
    use WithPagination;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre;

    //Render
    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.materias.view', [
            'materias' => Materia::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
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
    }

    //Agregar datos
    public function store(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
        ]);

        //Crear materia
        Materia::create([ 
			'nombre' => $this-> nombre
        ]);

        //Registro de auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado la materia: ' . $this->nombre,
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

        $record = Materia::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
    }

    //Actualizar datos
    public function update(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
        ]);

        //Verificar el ID de la materia
        if ($this->selected_id){

            //Actualizar materia
			$record = Materia::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre
            ]);

           //Registro de auditoria
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

    //Eliminar materia
    public function destroy($id){

        //Verificar si existe el ID
        if ($id){
            
           //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario eliminado una materia',
            ]);

            //Borrar materia
            Materia::where('id', $id)->delete();
        }
    }
}