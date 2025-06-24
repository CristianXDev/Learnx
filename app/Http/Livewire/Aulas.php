<?php

namespace App\Http\Livewire;

//Componentes Livewire
use Livewire\Component;
use Livewire\WithPagination;

//Componente de autenificación
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Aula;
use App\Models\Auditoria;

//Clase principal
class Aulas extends Component{

    //Componente - Paginación
    use WithPagination;

    //Integración con Bootstrap
	protected $paginationTheme = 'bootstrap';

    //Variables
    public $selected_id, $keyWord, $nombre;

    //Render
    public function render(){

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.aulas.view', [
            'aulas' => Aula::latest()
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

        //Crear aula presencial
        Aula::create([ 
			'nombre' => $this-> nombre
        ]);

        //Registro de auditoria
        Auditoria::create([ 
            'usuario_id' => Auth::user()->id,
            'descripcion' => 'El usuario ha agregado la aula presencial: ' . $this->nombre,
        ]);
        
        //Resetar inputs
        $this->resetInput();

        //Cerrar modal
		$this->dispatchBrowserEvent('closeModal');

        //Mensaje guardado en la sesión
		session()->flash('message', 'Aula Successfully created.');
    }

    //Inicializar variables
    public function edit($id){

        $record = Aula::findOrFail($id);
        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
    }

    //Actualizar datos
    public function update(){

        //Validar campos
        $this->validate([
		'nombre' => 'required',
        ]);

        //Verificar el ID de la categoria
        if ($this->selected_id){

            //Actualizar categoria
			$record = Aula::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre
            ]);

            //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario ha actualizado el aula presencial: ' . $this->nombre,
            ]);

            //Resetar inputs
            $this->resetInput();

            //Cerrar modal
            $this->dispatchBrowserEvent('closeModal');

            //Mensaje guardado en la sesión
			session()->flash('message', 'Aula Successfully updated.');
        }
    }

    //Eliminar materia
    public function destroy($id){

        //Verificar si existe el ID
        if ($id){

            //Registro de auditoria
            Auditoria::create([ 
                'usuario_id' => Auth::user()->id,
                'descripcion' => 'El usuario eliminado un aula presencial',
            ]);

            //Borrar aula presencial
            Aula::where('id', $id)->delete();
        }
    }
}